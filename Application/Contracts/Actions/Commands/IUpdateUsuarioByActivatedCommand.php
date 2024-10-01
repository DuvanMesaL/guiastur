<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/UseCases/GetUsusarioByToken/Dto/UpdateUsuarioByActivatedRequest.php";

interface IUpdateUsuarioByActivatedCommand {
    public function handler(UpdateUsuarioByActivatedRequest $request);
}