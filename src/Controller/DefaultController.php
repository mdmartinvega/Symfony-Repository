<?php

declare(strict_types=1);
namespace App\Controller;

use App\Entity\Employee;
use App\Repository\EmployeeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


//AbstractController es un controlador de Symfony
//que pone a disposición nuestra multitud de caracteristicas
class DefaultController extends AbstractController
{

    // Lo comentamos para trabajar con la BBDD
    // const PEOPLE = [
    //     ['name' => 'Carlos', 'email' => 'carlos@correo.com', 'age' => 30, 'city' => 'Benalmádena'],
    //     ['name' => 'Carmen', 'email' => 'carmen@correo.com', 'age' => 25, 'city' => 'Fuengirola'],
    //     ['name' => 'Carmelo', 'email' => 'carmelo@correo.com', 'age' => 35, 'city' => 'Torremolinos'],
    //     ['name' => 'Carolina', 'email' => 'carolina@correo.com', 'age' => 38, 'city' => 'Málaga'],
    // ];

    /**
     * @Route("/default", name="default_index")
     * La clase ruta debe estar precedida en los comentarios por una @
     * El primer parámetro de Route es la URL a la que queremos asociar la acción.
     * El segundo parámetro de Route es el nombre que queremos dar a la ruta
     */
    public function index(Request $request, EmployeeRepository $employeeRepository): Response 
    {

        if ($request->query->has('term')) {
            $people = $employeeRepository->findByTerm($request->query->get('term'));

            return $this->render('default/index.html.twig', [
                'people'=> $people
            ]); 
        }
        // echo '<pre>query id: '; var_dump($solicitud->query->get('id')); echo '</pre>';
        // echo '<pre>request: '; var_dump($solicitud->request); echo '</pre>';
        // echo '<pre>server: '; var_dump($solicitud->server); echo '</pre>';
        // echo '<pre>file: '; var_dump($solicitud->files); echo '</pre>';

        //Una acción siempre debe devolver una respuesta.
        //Por defecto deberá ser un objeto de la clase
        //Symfony\Component\HttpFoundation\Response;
        
        //render() es un método heredado de AbstractControoller
        //que devuelve el contenido declarado en una plantilla de Twig
        // https://twig.symfony.com/doc/3.x/templates.html

        //symfony console es un comando equivalente a php bin/console

        // $name = 'Loli';

        //método1: accediendo al repositorio a través de AbstractController
        // $people = $this->getDoctrine()->getRepository(Employee::class)->findAll();

        $order = [];
        if ($request->query->has('orderBy')) {
            $order[$request->query->get('orderBy')] = $request->query->get('orderDir', 'ASC');
        }
        //Método 2: creando un parámetro indicando el tipo.
        $people = $employeeRepository->findBy([], $order);

        return $this->render('default/index.html.twig', [
            'people'=> $people
            // 'people'=> self::PEOPLE
        ]);   
    }





    /**
     * @Route("/saludo", name="default_saludo")
     */
    public function Saludo(): Response {
        return new Response('<html><body>hola</body></html>');
    }

     /**
     * @Route(
     *      "/default.{_format}", 
     *      name="default_index_json",
     *      requirements = {
     *          "_format": "json"
     *      }
     * )
     * 
     * El comando:
     * symfony console router:match /default.json
     * buscará la acción coincidente con la ruta indicada 
     * y mostrará la información asociada
     */
    public function indexJson(Request $request, EmployeeRepository $employeeRepository): JsonResponse {
        // return $this->json(self::PEOPLE);Equivalente a lo de abajo
        // return new JsonResponse(self::PEOPLE);
        $result = $request->query->has('id') ?
        $employeeRepository->find($request->query->get('id')) :
        $employeeRepository->findAll();

        $data = [];

        foreach ($result as $employee) {
            array_push($data, $this->normalizeEmployee($employee));
        }

        return $this->json($data);

    }

     /**
     * @Route(
     *      "/default/{id}",
     *      name="default_show",
     *      requirements = {
     *          "id": "\d+"
     *      }
     * )
     */
    public function show(int $id, EmployeeRepository $employeeRepository): Response {
        // var_dump($id); die();
        $data = $employeeRepository->find($id);

        return $this->render('default/show.html.twig', [
            'id' => $id,
            'person' => $data
            // 'person' => self::PEOPLE[$id]

        ]);
    }

    //Opción para inyectar directamente un objeto del tipo indicado como parámetro 
    //intentando hacer un match del parámetro de la ruta con alguna de las propiedadas
    //del objeto requerido
    // public function show(Employee $employee): Response {
    //     return $this->render('default/show.html.twig', [
    //         'person' => $employee
    //     ]);
    // }


    /**
     * @Route("/redirect-to-home", name="default_redirect_to_home")
     */

    public function redirectToHome(): Response {
        //Redirigir a la URL /
        // return $this->redirect('/');

        //Redirigir a una ruta utilizando su nombre
        // return $this->redirectToRoute('default_show', ['id' => 1]);

        //Devolver directamente un objeto RedirectResponse
        return new RedirectResponse('/', Response::HTTP_TEMPORARY_REDIRECT);

    }

    private function normalizeEmployee (Employee $employee): ?array {
        $projects = [];

        foreach($employee->getProjects() as $project) {
            array_push($projects, [
                'id' => $project->getId(),    
                'name' => $project->getName(),    
            ]);
        }

        return [
            'name' => $employee->getName(),
            'email' => $employee->getEmail(),
            'city' => $employee->getCity(),
            'department' => [
                'id' => $employee->getDepartment()->getId(),
                'name' => $employee->getDepartment()->getName(),
            ],
            'projects' => $projects
        ];
    }

    //EJERCICIO
    //Crear el recurso para obtener una representación
    //de UN empleado enb formato JSON

    /**
     * @Route(
     *      "/default/{id}.{_format}", 
     *      name="default_show_json",
     *      requirements = {
     *          "_format": "json",
     *          "id": "\d+"
     *      }
     * )
     * 
     * El comando:
     * symfony console router:match /default.json
     * buscará la acción coincidente con la ruta indicada 
     * y mostrará la información asociada
     */
    public function userJson(int $id, EmployeeRepository $employeeRepository): JsonResponse {
        $result = $employeeRepository->find($id);
        $data = $this->normalizeEmployee($result);

        return $this->json($data);
    }

    //Otra opción:
    // public function userJson(Request $request): JsonResponse {
    //     $person = $request->query->has('id') ? self::PEOPLE[$request->query->get('id')] : self::PEOPLE;
    //     return $this->json($person);

    // public function indexJson(Request $request, EmployeeRepository $employeeRepository): JsonResponse {
    //     $data = $request->query->has('id') ? 
    //         $employeeRepository->find($request->query->get('id')) :
    //         $employeeRepository->findAll();

    //     return $this->json($data);
    // }
    // }

   
}