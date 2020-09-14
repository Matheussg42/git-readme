<?php

namespace App;

require __DIR__ . '/../vendor/autoload.php';


class Github
{

    private string $user;
    private string  $endpoint;
    private int  $numRepositorios;
    private array $repositories;

    /**
     * O metodo construtor espera receber um usuario para retornar a lista de repositorios publicos.
     * 
     * @param string $user
     */
    public function __construct(string $user)
    {
        $this->user = $user;
        $this->endpoint = "https://api.github.com/users/{$user}/repos";
        $this->repositories = $this->getPublicRepositories();
        $this->numRepositorios = count($this->getPublicRepositories());
    }

    public function getRepositories(): array
    {
        return $this->repositories;
    }

    public function getnumRepositorios(): int
    {
        return $this->numRepositorios;
    }

    public function getUser(): string
    {
        return $this->user;
    }


    public function getLinguagens(): array
    {
        $linguagens = array();

        $umPorcento = floor(((100 / $this->numRepositorios) * 100)) / 100;

        foreach ($this->repositories as $repositorio) {

            if (empty($repositorio['language'])) {
                $repositorio['language'] = 'Markdown';
            }

            if (!array_key_exists($repositorio['language'], $linguagens)) {
                $linguagens[$repositorio['language']] = $umPorcento;
            } else {
                $linguagens[$repositorio['language']] += $umPorcento;
            }
        }

        return $linguagens;
    }

    public function getLinguagensString(array $linguagens): string
    {
        $string = "";

        foreach ($linguagens as  $key => $value) {
            $string .= "> **{$key} -> {$value}%**" . PHP_EOL . PHP_EOL;
        }

        return $string;
    }

    private function getPublicRepositories(): array
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', $this->endpoint, []);
        return json_decode($res->getBody(), true);
    }
}
