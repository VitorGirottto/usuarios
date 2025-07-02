<?php
$cadastro = [];

while (true) {
    echo "\n========= MENU =========\n";
    echo "1 - Criar usuário\n";
    echo "2 - Excluir usuário\n";
    echo "3 - Listar todos os usuários\n";
    echo "4 - Editar usuário\n";
    echo "5 - Listar um único usuário\n";
    echo "6 - Sair\n";
    echo "Escolha uma opção: ";
    
    $acao = trim(fgets(STDIN));

    switch ($acao) {
        case 1:
            echo "\nDigite o email do usuário: ";
            $emaildigitado = trim(fgets(STDIN));

            if (isset($cadastro[$emaildigitado])) {
                echo "Email já cadastrado!\n";
            } else {
                echo "Digite o nome do usuário: ";
                $nomedigitado = trim(fgets(STDIN));

                $cadastro[$emaildigitado] = [
                    'nome' => $nomedigitado,
                    'data_cadastro' => date('Y-m-d H:i:s'),
                    'data_atualizacao' => null
                ];
                echo "Usuário cadastrado com sucesso!\n";
            }
            break;

        case 2:
            echo "\nDigite o email do usuário que deseja excluir: ";
            $emaildigitado = trim(fgets(STDIN));

            if (isset($cadastro[$emaildigitado])) {
                unset($cadastro[$emaildigitado]);
                echo "Usuário com o email $emaildigitado excluído com sucesso.\n";
            } else {
                echo "Usuário não encontrado.\n";
            }
            break;

        case 3:
            if (empty($cadastro)) {
                echo "Não há usuários cadastrados.\n";
            } else {
                echo "\n===== Lista de Usuários =====\n";
                foreach ($cadastro as $email => $dados) {
                    echo "Email: $email\n";
                    echo "Nome: " . $dados['nome'] . "\n";
                    echo "Data de Cadastro: " . $dados['data_cadastro'] . "\n";
                    echo "Última Atualização: " . ($dados['data_atualizacao'] ?? "Nunca atualizado") . "\n";
                    echo "-----------------------------\n";
                }
            }
            break;

        case 4:
            echo "Digite o email do usuário que deseja editar: ";
            $emaildigitado = trim(fgets(STDIN));

            if (!isset($cadastro[$emaildigitado])) {
                echo "Usuário não encontrado.\n";
            } else {
                echo "Digite o novo nome (ou deixe em branco para manter): ";
                $novonome = trim(fgets(STDIN));

                echo "Digite o novo email (ou deixe em branco para manter): ";
                $novoemail = trim(fgets(STDIN));

                if (!empty($novonome)) {
                    $cadastro[$emaildigitado]['nome'] = $novonome;
                }

                $cadastro[$emaildigitado]['data_atualizacao'] = date('Y-m-d H:i:s');

                if (!empty($novoemail) && $novoemail !== $emaildigitado) {
                    if (isset($cadastro[$novoemail])) {
                        echo "Não foi possível atualizar o email: já existe outro usuário com esse email.\n";
                    } else {
                        $cadastro[$novoemail] = $cadastro[$emaildigitado];
                        unset($cadastro[$emaildigitado]);
                        echo "Email atualizado com sucesso.\n";
                    }
                }

                echo "Usuário atualizado com sucesso.\n";
            }
            break;

        case 5:
            echo "Digite o email do usuário: ";
            $emaildigitado = trim(fgets(STDIN));

            if (isset($cadastro[$emaildigitado])) {
                $dados = $cadastro[$emaildigitado];
                echo "\n===== Usuário Encontrado =====\n";
                echo "Email: $emaildigitado\n";
                echo "Nome: " . $dados['nome'] . "\n";
                echo "Data de Cadastro: " . $dados['data_cadastro'] . "\n";
                echo "Última Atualização: " . ($dados['data_atualizacao'] ?? "Nunca atualizado") . "\n";
                echo "==============================\n";
            } else {
                echo "Usuário não encontrado.\n";
            }
            break;

        case 6:
            echo "Encerrando o programa...\n";
            exit;

        default:
            echo "Opção inválida, tente novamente!\n";
    }
}
