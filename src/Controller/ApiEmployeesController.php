<?php

namespace App\Controller;


use App\Entity\Employee;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/amazing-employees", name="api_employees_")
 */

class ApiEmployeesController extends AbstractController
{
    /**
     * @Route(
     *      "", 
     *      name="cget",
     *      methods={"GET"})
     */
    public function index(Request $request, EmployeeRepository $employeeRepository): Response
    {
        if($request->query->has('term')) {
            $people = $employeeRepository->findByTerm($request->query->get('term'));
            return $this->json($people);
        }

        return $this->json($employeeRepository->findAll());
    }

     /**
     * @Route(
     *      "/{id}", 
     *      name="get",
     *      methods={"GET"},
     *      requirements={
     *          "id": "\d+"  
     *      }
     * ) 
     * Cualquier dígito del 1 al 9 y el + que se puede repetir
     */

    

    public function show(Employee $employee): Response
    {
        return $this->json($employee);
    }


    /**
     * @Route(
     *      "",
     *      name="post",
     *      methods={"POST"}
     * )
     */

    public function add(
        Request $request,
        EntityManagerInterface $entityManager): Response
    {   
        $data = $request->request;
        $employee = new Employee();

        $employee->setName($data->get('name'));
        $employee->setEmail($data->get('email'));
        $employee->setAge($data->get('age'));
        $employee->setCity($data->get('city'));
        $employee->setPhone($data->get('phone'));

        $entityManager->persist($employee);

        //Hasta aquí employee aún no tiene id asignado

        $entityManager->flush();

        dump($employee);

        return $this->json(
            $employee,
            Response::HTTP_CREATED,
            [
                'Location' => $this->generateUrl(
                    'api_employees_get',
                    [
                        'id' => $employee->getId()
                    ]
                )
            ]
        );
    }


    /**
     * @Route(
     *      "/{id}",
     *      name="put",
     *      methods={"PUT"},
     *      requirements={
     *      "id": "\d+" 
     *      }
     * )
     * Cualquier dígito del 1 al 9 y el + que se puede repetir
     */

    public function update(int $id): Response
    {
        return $this->json([
            'method' => 'PUT',
            'description' => 'Actualiza un recurso empleado con id: '.$id.'.',
        ]);
    }

     /**
     * @Route(
     *      "/{id}",
     *      name="delete",
     *      methods={"DELETE"},
     *      requirements={
     *          "id": "\d+"
     *      }
     * )
     * Cualquier dígito del 1 al 9 y el + que se puede repetir
     */

    public function remove(
        Employee $employee,
        EntityManagerInterface $entityManager
        ): Response
    {

        // $employee = $employeeRepository->find($id);

        // if(!$employee) {
        //     return $this->json([
        //         'message' => sprint('No he encontrado el empleado con ese id')
        //     ], Response::HTTP_NO_CONTENT)
        // }
        dump($employee);

        //remove prepara el sistema pero no ejecuta la sentencia

        $entityManager->remove($employee);
        $entityManager->flush();

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }

}
