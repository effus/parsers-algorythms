<?php
namespace effus\parsers;

use \effus\runner\ParserResults;

/**
 * Find all Youtube links like "/watch?v=8hP6WROycAU" by regexp
 */
class YoutubeLinks implements InterfaceParser
{

    /**
     * Main parsing method
     *
     * @param string $data
     * @return ParserResults
     */
    public function process(string $resource) : ParserResults
    {
        $out = new ParserResults();
        $ms = microtime(true);
        $response = \HttpClient::request($resource);
        if ($response[1]['http_code'] != 200) {
            throw new \Exception('Bad HTTP response code: ' . $response[1]['http_code']);
        }
        $data = $response[0];
        $out->addStat('requests', (microtime(true) - $ms));
        $ms = microtime(true);
        $videoLinks = $this->getUniqueLinks($data);
        $out->addStat('parsing', (microtime(true) - $ms));
        \effus\outputStr('Retrieve view counts...');
        $videoViews = [];
        $viewsIndex = [];

        foreach ($videoLinks as $_vl) {
            $ms = microtime(true);
            try {
                $cnt = $this->getViewsCount('https://www.youtube.com/watch?v=' . $_vl);
            } catch (\Exception $e) {
                \effus\outputStr(' ERROR, Retry');
                try {
                    $cnt = $this->getViewsCount('https://www.youtube.com/watch?v=' . $_vl);
                } catch (\Exception $e) {
                    \effus\outputStr(' Nope... So, skip');
                    continue;
                }
            }
            $out->addStat('requests', (microtime(true) - $ms));

            $_vln = $_vl . ' /' . $cnt;
            if (!isset($videoViews[$cnt])) {
                $videoViews[$cnt] = [$_vln];
            }
            else {
                $videoViews[$cnt][] = $_vln;
            }
            $viewsIndex[] = $cnt;
        }
        $out->setIndex($viewsIndex);
        $out->setData($videoViews);
        return $out;
    }

    private function getUniqueLinks($data, $maxCount = 50) : array
    {
        $a1 = preg_match_all('/\/watch\?v\=([A-z0-9\_\-]{11})/ui', $data, $matches1);
        $a2 = preg_match_all('/\"videoId\"\:\"([A-z0-9\_\-]{11})\"/ui', $data, $matches2);
        $_founded = $matches1[1] + $matches2[1];
        $links = [];
        foreach ($_founded as $_f) {
            if (!\in_array($_f, $links)) {
                $links[] = $_f;
                if ($maxCount) {
                    $maxCount--;
                }
                else
                    break;
            }
        }
        return $links;
    }

    private function getViewsCount($videoUrl) : int
    {
        \effus\outputStr('GET ' . $videoUrl, false);
        $response = \HttpClient::request($videoUrl);
        \effus\outputStr(" ...  code:" . $response[1]['http_code'], false);
        if ($response[1]['http_code'] != 200) {
            throw new \Exception('Bad HTTP response code: ' . $response[1]['http_code'] . ' for URL: ' . $videoUrl);
        }
        $data = $response[0];
        preg_match('/\,\"view_count\"\:\"([0-9]+)\",/ui', $data, $matches);
        if (!isset($matches[1])) {
            throw new \Exception('Views count not found for video: ' . $videoUrl);
        }
        \effus\outputStr(" ... views: " . $matches[1]);
        return (int)$matches[1];
    }


/*
    private function compareStrings($str1, $str2)
    {
        $_n1 = $this->str2Num($str1);
        $_n2 = $this->str2Num($str2);
        return $_n1 > $_n2 ? -1 : ($_n1 < $_n2 ? 1 : 0);
    }

    private function str2Num($str)
    {
        $out = 0;
        for ($i = 0; $i < strlen($str); $i++) {
            $out .= ord($str[$i]);
        }
        return substr($out, 0, 11);
    }*/
}