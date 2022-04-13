<?php namespace  Aliakbar\UrlShortener\Helper;

class View
{
    function render($template, array $data = array())
    {
        $DS  = DIRECTORY_SEPARATOR;

        $template = __DIR__ . "/../../templates/{$template}";

        if (!is_file($template)) {
            throw new \RuntimeException('Template not found: ' . $template);
        }

        $result = function($file, $data) {
            ob_start();
            extract($data, EXTR_SKIP);
            try {
                include $file;
            } catch (\Exception $e) {
                ob_end_clean();
                throw $e;
            }
            return ob_get_clean();
        };
        echo $result($template, $data);
    }
}
