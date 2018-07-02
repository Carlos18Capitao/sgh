<?php

namespace App\Http\Controllers;

use Goutte\Client;
use Illuminate\Http\Request;

class ScrapingController extends Controller
{
    public function example(Client $client)
    {

        $crawler = $client->request('GET', 'http://farmacia.uncisal.edu.br/');
        $form = $crawler->selectButton('Acessar')->form();
        $crawler = $client->submit($form, array('username' => '03665193443', 'password' => 'n0rd3st3'));
        $crawler = $client->click($crawler->selectLink('Avaliações')->link());
        $crawler = $client->click($crawler->selectLink('PENDENTE DE AVALIAÇÃO')->link());

//        $class = $crawler->filterXPath('//body/tr')->attr('class');
        $crawler->filter('tbody > tr')->each(function ($reqNode) {
            $avaliacaoNode = $reqNode->filter('tr > th')->first();
            $tds = $reqNode->children()->filter('td');
            $numeroRequisicao = $tds->eq(0);
            $unidadeRequisicao = $tds->eq(1);
            $dataRequisicao = $tds->eq(3);
//            dd($dataRequisicao->text());

//            $requisicaoNode = $reqNode->filter('tr > td')->first();
//            $requisicaoNode = $reqNode->filter('tr > td')->first();
            echo '<a href="http://farmacia.uncisal.edu.br/avaliacao/avaliacaorequisicao/' . $avaliacaoNode->text() . '">' . $numeroRequisicao->text() . '</a>' . ' - ' . $dataRequisicao->text() . ' - ' . $unidadeRequisicao->text() . '<br>';;
        });
    }
        public function reqsis(Request $request, Client $client)
    {

        $crawler = $client->request('GET', 'http://farmacia.uncisal.edu.br/avaliacao/avaliacaorequisicao/');
        $form = $crawler->selectButton('Acessar')->form();
        $crawler = $client->submit($form, array('username' => '03665193443', 'password' => 'n0rd3st3'));
        $crawler = $client->click($crawler->selectLink('Avaliações')->link());
        $crawler = $client->click($crawler->selectLink('PENDENTE DE AVALIAÇÃO')->link());

        $filtro = $crawler->filter('tbody > tr')->each(function ($reqNode){
            $avaliacaoNode = $reqNode->filter('tr > th')->first();
            $tds = $reqNode->children()->filter('td');
            $numeroRequisicao = $tds->eq(0);
            $unidadeRequisicao = $tds->eq(1);
            $dataRequisicao = $tds->eq(3);

//            $crawler = $client->click($crawler->selectLink($avaliacaoNode->text())->link());

            echo '<a href="http://farmacia.uncisal.edu.br/avaliacao/avaliacaorequisicao/'.$avaliacaoNode->text().'">' .
                        $numeroRequisicao->text() . '</a>' . ' - ' .
                        $dataRequisicao->text() . ' - ' .
                        $unidadeRequisicao->text() .  '<br>';
        });

    }
}
