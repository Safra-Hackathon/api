<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatabaseTest extends TestCase
{
    /**
     * Test if has database.
     *
     * @return void
     */
    public function testDatabaseHasAdminUser()
    {
        $this->assertDatabaseHas('users', [
            'email' => 'admin@admin.com',
        ]);
    }

    # Outros testes:
    #TODO: Verificar se existe a tabela
    #TODO: Inserir o usuário na tabela -- lembrar que após o teste ele é deletado
    #TODO: Verificar se existe o usuário
}
