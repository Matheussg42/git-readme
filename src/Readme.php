<?php

namespace App;

require __DIR__ . '/../vendor/autoload.php';


class Readme
{
    private string $arquivo;
    private string $readme;

    public function __construct(string $arquivo, string $readme)
    {
        $this->arquivo = $arquivo;
        $this->readme = $readme;
    }

    public function gerarArquivo()
    {
        try {
            if (file_exists($this->arquivo)) {
                unlink($this->arquivo);
            }
            $arquivo = fopen($this->arquivo, 'w+');
            fwrite($arquivo, $this->readme);
            fclose($arquivo);

            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }
}
