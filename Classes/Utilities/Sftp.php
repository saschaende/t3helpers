<?php

namespace SaschaEnde\T3helpers\Utilities;

use TYPO3\CMS\Core\SingletonInterface;

class Sftp implements SingletonInterface
{

    private $connection = null;
    private $sftp = null;

    /**
     * @param $host
     * @param $username
     * @param $password
     * @param int $port
     * @return $this
     * @throws \Exception
     */
    public function login($host, $username, $password, $port = 22)
    {
        $this->connection = @ssh2_connect($host, $port);
        if (!$this->connection)
            throw new \Exception("Could not connect to $host on port $port.");

        if (!@ssh2_auth_password($this->connection, $username, $password))
            throw new \Exception("Could not authenticate with username $username " .
                "and password $password.");

        $this->sftp = @ssh2_sftp($this->connection);
        if (!$this->sftp)
            throw new \Exception("Could not initialize SFTP subsystem.");
        return $this;
    }

    /**
     * @param $local_file
     * @param $remote_file
     * @throws \Exception
     */
    public function uploadFile($local_file, $remote_file)
    {
        $sftp = $this->sftp;
        $stream = @fopen('ssh2.sftp://' . $sftp . $remote_file, 'w');

        if (!$stream)
            throw new \Exception("Could not open file: $remote_file");

        $data_to_send = @file_get_contents($local_file);
        if ($data_to_send === false)
            throw new \Exception("Could not open local file: $local_file.");

        if (@fwrite($stream, $data_to_send) === false)
            throw new \Exception("Could not send data from file: $local_file.");

        @fclose($stream);
    }

    /**
     * @param $remote_file
     * @param $local_file
     * @return $this
     * @throws \Exception
     */
    public function downloadFile($remote_file, $local_file)
    {
        $remotehandle = @fopen('ssh2.sftp://' . $this->sftp . $remote_file, 'r');

        if (!$remotehandle) {
            throw new \Exception("Could not open file: $remote_file");
        }

        $localhandle = @fopen($local_file, 'w');

        if (!$localhandle) {
            throw new \Exception("Could not open file: $local_file");
        }

        while ($chunk = @fread($remotehandle, 8192)) {
            @fwrite($localhandle, $chunk);
        }

        @fclose($remotehandle);
        @fclose($localhandle);
        return $this;
    }

    /**
     * @param $remote_dir
     */
    public function listDir($remote_dir){
        $dir = 'ssh2.sftp://' . $this->sftp . $remote_dir;
        $handle = opendir($dir);
        $return = [];
        while (false != ($entry = readdir($handle))){
            if($entry == '.' || $entry == '..'){
                continue;
            }
            if(is_dir($dir.DIRECTORY_SEPARATOR.$entry)){
                $file = false;
            }else{
                $file = true;
            }
            $return[] = [
                'name' => $entry,
                'path' => $remote_dir.DIRECTORY_SEPARATOR.$entry,
                'isFile' => $file
            ];
        }
        return $return;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function currentDirectory(){
        return $this->exec('pwd')[1];
    }

    /**
     * @param $cmd
     * @return string[]
     * @throws \Exception
     */
    public function exec($cmd){
        $stdout = ssh2_exec($this->connection, $cmd);
        $stderr = ssh2_fetch_stream($stdout, SSH2_STREAM_STDERR);
        if (!empty($stdout)) {

            $t0 = time();
            $err_buf = null;
            $out_buf = null;

            // Try for 30s
            do {

                $err_buf.= fread($stderr, 4096);
                $out_buf.= fread($stdout, 4096);

                $done = 0;
                if (feof($stderr)) {
                    $done++;
                }
                if (feof($stdout)) {
                    $done++;
                }

                $t1 = time();
                $span = $t1 - $t0;

                // Wait here so we don't hammer in this loop
                sleep(1);

            } while (($span < 30) && ($done < 2));

            return [$err_buf,$out_buf];

        } else {
            throw new \Exception("Failed to Shell");
        }
    }

    /**
     *
     */
    public function disconnect()
    {
        $this->connection = null;
        unset($this->connection);
    }

    /**
     *
     */
    public function __destruct(){
        if($this->connection){
            $this->connection = null;
            unset($this->connection);
        }
    }

}