<?php namespace  Aliakbar\UrlShortener\Helper;

class View
{
    private $rootPath;

    public function filesystemLoader(string $rootPath = null)
    {
        $this->rootPath = (null === $rootPath ? getcwd() : $rootPath).\DIRECTORY_SEPARATOR;
        if (null !== $rootPath && false !== ($realPath = realpath($rootPath))) {
            $this->rootPath = $rootPath.\DIRECTORY_SEPARATOR;
        }

        return $this->rootPath;
    }

    function render($template, array $data = array())
    {

        $template = $this->filesystemLoader(getcwd() . '/../templates/') . $template;

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
