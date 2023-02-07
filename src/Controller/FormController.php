<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\HistoricalApi;
use App\Transformer\HistoricalDataTransformer;
use Symfony\Component\HttpKernel\Attribute\Cache;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\SymbolFormType;
use App\Entity\Form;
use App\Factories\MailerDataFactory;
use Twig\Environment;
use App\Service\Mailer;

class FormController extends AbstractController
{

    public function __construct(protected Mailer $mailer, private MailerDataFactory $mailerDataFactory)
    {
        $this->mailer = $mailer;
        $this->mailerDataFactory = $mailerDataFactory;
    }
    
    public function index(Environment $twig, Request $request) {

        $formEntity = new Form();
        $form = $this->createForm(SymbolFormType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $mailData = $this->mailerDataFactory->create($data);
            
            $this->mailer->send($mailData);
            return $this->redirectToRoute('historical_api', ['endDate' => strtotime($data->endDate->format('Y-m-d')), 'startDate' => strtotime($data->startDate->format('Y-m-d')), 'symbol' => $data->getCompanySymbol()]);
        }

        return new Response($twig->render('form/index.html.twig', 
            [
                'form' => $form->createView()
            ])
        );
    }

    public function table(Request $request, HistoricalApi $client, HistoricalDataTransformer $transformer, int $endDate, int $startDate) {
        $params = ['symbol' => $request->query->get('symbol')];
        $data = $client->fetch($params);

        $dataInGivenRange = array_filter($data['prices'], function($item) use($startDate, $endDate) {
            if($item['date'] > $startDate && $item['date'] < $endDate) {
                return $item;
            }
        });

        $items = $transformer->transform($dataInGivenRange);
        return $this->render('table.html.twig', ['items' => $items]);
    }
}