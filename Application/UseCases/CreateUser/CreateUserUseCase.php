<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/UseCases/ICreateUserUseCase.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/Application/Contracts/Actions/Commands/ICreateUserCommand.php";
require_once __DIR__ . "/Dto/CreateUserRequest.php";
require_once __DIR__ . "/Dto/CreateUserResponse.php";


class CreateUserUseCase implements ICreateUserUseCase {
    private $createUserCommand;

    public function __construct(ICreateUserCommand $createUserCommand)
    {
        $this->createUserCommand = $createUserCommand;
    }

    public function createUser(CreateUserRequest $request) : CreateUserResponse{
      return  $this->createUserCommand->handler($request);
    }
}