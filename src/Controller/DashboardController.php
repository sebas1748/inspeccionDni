<?php

namespace App\Controller;

use App\Entity\DniRecibidos;
use App\Entity\Lote;
use App\Form\LoteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(Request $request, SluggerInterface $slugger): Response
    {
        $lote = new Lote();
        $form = $this->createForm(LoteType::class, $lote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $PATHFile */
            $brochureFile = $form['brochure']->getData();
            if ($brochureFile) {
                $originalFilename1 = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename1 = $slugger->slug($originalFilename1);
                $newFilename1 = 'recibido' . '.' . $brochureFile->guessExtension();
                try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename1
                    );
                } catch (FileException $e) {
                    throw new \Exception('Ups. A ocurrido un error al subir el archivo');
                    // ... handle exception if something happens during file upload
                }
                $lote->setBrochureFilename($newFilename1);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lote);
            $entityManager->flush();

            return $this->redirectToRoute('file-save');
        }
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'lote' => $lote,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/filesave", name="file-save")
     */
    public function saveData(Request $request, SluggerInterface $slugger): Response
    {

        /*$file = fopen("./file/sebas.txt", "r") or exit("No se puede abrir el archivo");

        while (!feof($file)) {
            echo fgets($file) . "<br />";
        }
        fclose($file);*/

        $cardelimitador = '"';
        $carpeta = './file/brochures/';
        $nomarxiu = 'recibido.txt';

        $oa = fopen($carpeta . $nomarxiu, 'r') or exit("No se puede abrir el archivo");

        $c = 0;

        $entityManager = $this->getDoctrine()->getManager();

        while ($a = fgetcsv($oa, 1000, $cardelimitador)) {
            $c++;
            $prefijo = 0000;

            $dnirecibido = new DniRecibidos();

            $dnirecibido->setApellido($a[1]);
            $dnirecibido->setNombres($a[2]);
            $dnirecibido->setSexo($a[3]);
            $dnirecibido->setDni($a[4]);
            $dnirecibido->setEjemplar($a[5]);
            $dnirecibido->setFecnac($a[6]);
            $dnirecibido->setFectra($a[7]);
            $dnirecibido->setDelegacion(1);
            $dnirecibido->setTramite($prefijo . $c);
            $dnirecibido->setNdel("0");
            $dnirecibido->setDelegacion(1);
            $dnirecibido->setEstado("1");
            $dnirecibido->setLote(1);

            $entityManager->persist($dnirecibido);
            $entityManager->flush();
        }

        echo 'total registros: ' . $c;
        fclose($oa);


        return $this->render('dashboard/pruebaguardado.html.twig', [
            'controller_name' => 'DashboardController',
        ]);

    }
}