<?php

/**
 * This class is a common class for every plugin developed by orbisius.com team.
 *
 * @author Svetoslav Marinov | http://orbisius.com
 */
class WebWeb_WP_MibewCrawler {
    protected $user_agent = "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:6.0) Gecko/20100101 Firefox/6.0";
    protected $error = null;
    protected $buffer = null;

    function __construct() {
        ini_set('user_agent', $this->user_agent);
    }

    /**
     * Error(s) from the last request
     *
     * @return string
     */
    function getError() {
        return $this->error;
    }

    // checks if buffer is gzip encoded
    function is_gziped($buffer) {
        return (strcmp(substr($buffer, 0, 8), "\x1f\x8b\x08\x00\x00\x00\x00\x00") === 0) ? true : false;
    }

    /*
      henryk at ploetzli dot ch
      15-Feb-2002 04:28
      http://php.online.bg/manual/hu/function.gzencode.php
     */

    function gzdecode($string) {
        if (!function_exists('gzinflate')) {
            return false;
        }

        $string = substr($string, 10);
        return gzinflate($string);
    }

    /**
     * Fetches a url and saves the data into an instance variable. The returned status is whether the request was successful.
     *
     * @param string $url
     * @return bool
     */
    function fetch($url) {
        $ok = 0;
        $buffer = '';

        $url = trim($url);

        if (!preg_match("@^(?:ht|f)tps?://@si", $url)) {
            $url = "http://" . $url;
        }

        // try #1 cURL
        // http://fr.php.net/manual/en/function.fopen.php
        if (empty($ok)) {
            if (function_exists("curl_init") && extension_loaded('curl')) {
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Encoding: gzip'));
                curl_setopt($ch, CURLOPT_TIMEOUT, 45);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_MAXREDIRS, 5); /* Max redirection to follow */
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
                curl_setopt($ch, CURLOPT_USERAGENT, $this->user_agent);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

                /* curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC ) ; // in the future pwd protected dirs
                  curl_setopt($ch, CURLOPT_USERPWD, "username:password"); */ //  http://php.net/manual/en/function.curl-setopt.php

                $string = curl_exec($ch);
                $curl_res = curl_error($ch);

                curl_close($ch);

                if (empty($curl_res) && strlen($string)) {
                    if ($this->is_gziped($string)) {
                        $string = $this->gzdecode($string);
                    }

                    $this->buffer = $string;

                    return 1;
                } else {
                    $this->error = $curl_res;
                    return 0;
                }
            }
        } // empty ok*/
        // try #2 file_get_contents
        if (empty($ok)) {
            $buffer = @file_get_contents($url);

            if (!empty($buffer)) {
                $this->buffer = $buffer;
                return 1;
            }
        }

        // try #3 fopen
        if (empty($ok) && preg_match("@1|on@si", ini_get("allow_url_fopen"))) {
            $fp = @fopen($url, "r");

            if (!empty($fp)) {
                $in = '';

                while (!feof($fp)) {
                    $in .= fgets($fp, 8192);
                }

                @fclose($fp);
                $buffer = $in;

                if (!empty($buffer)) {
                    $this->buffer = $buffer;
                    return 1;
                }
            }
        }

        return 0;
    }

    function get_content() {
        return $this->buffer;
    }
}