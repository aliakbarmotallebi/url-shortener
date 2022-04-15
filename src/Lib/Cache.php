<?php namespace Aliakbar\UrlShortener\Lib;

class Cache
{

  private $cacheDir;

  private $cacheFileExtension;

  private $cacheFileName;

  private $isEnableCache;

  public function __construct()
  {
    $this->setCacheDir( getenv('CACHE_DIR', './tmp/cache') )
         ->setCacheFileExtension('.cache')
         ->setEnableCache( getenv('CACHE_ENABLE', true ) );

  }
  public function setCacheFileExtension($cacheFileExtension)
  {
    $this->cacheFileExtension = $cacheFileExtension;
    return $this;
  }

  public function getCacheFileExtension()
  {
    return $this->cacheFileExtension;
  }

  public function setCacheDir($cacheDir)
  {
    if (substr($cacheDir, -1) !== "/"){
        $cacheDir .= "/";
    }

    $this->cacheDir = $_SERVER['DOCUMENT_ROOT'] . $cacheDir;
    return $this;
  }

  public function getCacheDir()
  {
    return $this->cacheDir;
  }

  public function getCacheFile(): string
  {
      return $this->getCacheDir() . $this->getCacheFileName() . $this->getCacheFileExtension();
  }

  public function setCacheFileName(string $name)
  {
       $this->cacheFileName = md5($name);

      return $this;
  }

  public function getCacheFileName(): string
  {
      return $this->cacheFileName;
  }

  protected function getCacheDirectory(): string
  {
      return $this->cacheDir;
  }

  public function saveCacheFile(string $name, $cache, int $lifetime = 3600)
  {
    if (!$this->isEnableCache()){
        return false;
    }

    if (!file_exists($this->getCacheDir())){
        @mkdir($this->getCacheDir(), 0755, true);
    }

    $this->setCacheFileName($name);
    $lifetime   = time() + $lifetime;
    $data       = serialize($cache);
    $result     = file_put_contents($this->getCacheFile() , $lifetime . PHP_EOL . $data);
    if ($result === false) {
        return false;
    }

  }

  public function isEnableCache(): bool
  {
    return (bool)$this->isEnableCache;
  }

  public function setEnableCache(bool $mode)
  {
    $this->isEnableCache = $mode;
    return $this;
  }

  public function loadFileCache(string $name)
  {
      $fileName = $this->setCacheFileName($name);

      $filepath = $this->getCacheFile();


      if (!is_readable($filepath)) {
        return false;
      }

      $file = @file_get_contents($filepath);

      if (!$file) {
          return false;
      }

      $lines    = file($filepath);
      $lifetime = array_shift($lines);
      $lifetime = (int) trim($lifetime);

      if ($lifetime !== 0 && $lifetime < time()) {
          @unlink($file);
          return false;
      }

      $serialized = join('', $lines);
      $data       = unserialize($serialized);
      return $data;
  }


  public function delete(string $name)
  {
    $this->setCacheFileName($name);
    if ( is_readable($this->getCacheFile()) ){
      return unlink($this->getCacheFile());
    }
  }

  public function remember($key, $ttl = 3600, \Closure $callback)
  {
    $this->setCacheFileName($key);
    if ( ! is_readable($this->getCacheFile()) ){
        $this->saveCacheFile($key, $callback() , $ttl);
    }
    return $this->loadFileCache($key);
  }



}
