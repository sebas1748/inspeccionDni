<?php

namespace App\Controller;

use App\Entity\DniRecibidos;
use App\Entity\Lote;
use App\Form\LoteType;
use App\Repository\DniRecibidosRepository;
use App\Repository\LoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            $lote->setCodigo(Lote::CODIGOLOTE + 1);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lote);
            $entityManager->flush();

            //$this->addFlash('id_new', $lote->getDelegaciones()->getDepId());
            //return $this->redirectToRoute('file_save');
            return $this->redirectToRoute('file_save', ['id'=>$lote->getId()]);
        }
        return $this->render('dashboard/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/fileSave/{id}", name="file_save", requirements={"id":"\d+"})
     */
    public function fileSave(Lote $lote, $id): Response
    {
        $cardelimitador = '"';
        $carpeta = './file/brochures/';
        $nomarxiu = 'recibido.txt';

        $oa = fopen($carpeta . $nomarxiu, 'r') or exit("No se puede abrir el archivo");

        $c = 0;

        $entityManager = $this->getDoctrine()->getManager();

        while ($a = fgetcsv($oa, 1000, $cardelimitador)) {
            $c++;

            $dnirecibido = new DniRecibidos();

            $dnirecibido->setApellido($a[1]);
            $dnirecibido->setNombres($a[2]);
            $dnirecibido->setSexo($a[3]);
            $dnirecibido->setDni($a[4]);
            $dnirecibido->setEjemplar($a[5]);
            $dnirecibido->setFecnac($a[6]);
            $dnirecibido->setFectra($a[7]);
            $dnirecibido->setDelegacion($lote->getDelegaciones()->getDepId());
            $dnirecibido->setTramite(1);
            $dnirecibido->setNdel("0");
            $dnirecibido->setEstado("1");
            $dnirecibido->setLote($lote->getId());

            $entityManager->persist($dnirecibido);
            $entityManager->flush();
        }

        //echo 'codigo '.$lote->getCodigo();
        echo 'total registros: ' . $c;
        fclose($oa);


        return $this->render('dashboard/pruebaguardado.html.twig', [

        ]);

    }

    /**
     * @Route("/dni_buscar", name="dni_search", methods={"GET"})
     */
    public function search(Request $request, DniRecibidosRepository $dniRecibidosRepository, LoteRepository $loteRepository)
    {
        $form = $this->createFormBuilder()
            ->add('dni', IntegerType::class,[
                'required' => false,
            ])
            ->add('codigo', TextType::class,[
                'required' => false,
            ])
            ->add('delegacion', TextType::class,[
                'required' => false,
            ])
            ->getForm();

        $form->handleRequest($request);
        //$data = $form->getData();
        //$dnirec = $dniRecibidosRepository->buscarPorDni($data['dni']);
        //var_dump('hola mundo: ', $dnirec);die();

        return $this->render('dashboard/dnisearch.html.twig', [
            'form' => $form->createView()
            //'dnirec' => $dnirec
        ]);
    }

    /**
     * @Route("/dni_resultado", name="dni_result", methods={"GET","POST"})
     */
    public function result(Request $request, DniRecibidosRepository $dniRecibidosRepository, LoteRepository $loteRepository)
    {
        $form = $this->createFormBuilder()
            ->add('dni', IntegerType::class,[
                'required' => false,
            ])
            ->add('codigo', TextType::class,[
                'required' => false,
            ])
            ->add('delegacion', TextType::class,[
                'required' => false,
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //echo 'entro';
            $em = $this->getDoctrine()->getManager();
            $params = $request->request->get('form');
            //var_dump('esto es params: ',$params);die();

            if($params['dni']){
                $dnirec = $dniRecibidosRepository->buscarPorDni($params['dni']);
                //var_dump('esto es dni de if: ', $dnirec);die();
            }else{
                $dnirec = $dniRecibidosRepository->buscarPorLoteDel($params['codigo'] , $params['delegacion']);
                //var_dump('esto es dni de else: ', $dnirec);die();
            }


            if (!$dnirec) {
                //echo 'no entro';
                $dnirec = null;
            }
        }

        return $this->render('dashboard/dniresult.html.twig', [
            'form' => $form->createView(),
            'dnirec' => $dnirec[0]
        ]);
    }
}