<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetRoles/Dto/GetRolesResponse.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/Actions/Queries/IGetRolesQuery.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/Repositories/IRolRepository.php";

class GetRolesQueryHandler implements IGetRolesQuery {
    private $rolRepository;
    public function __construct(IRolRepository $rolRepository) {
        $this->rolRepository = $rolRepository;
    }

    public function handler() : GetRolesResponse {
        $rolesEntity = $this->rolRepository->findAll();
        $rolList = array();
        foreach ($rolesEntity as $rol) {
            $rolList[] = new RolResponse(
                $rol->id,
                $rol->nombre,
                $rol->descripcion,
                $rol->icono
            );
        }
        return new GetRolesResponse($rolList);
    }
}
