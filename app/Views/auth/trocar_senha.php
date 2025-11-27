<?php 
    $this->extend('layout/layoutSistema');
    $this->section('conteudo');
?>

<?= exibeTitulo('Trocar Senha', []) ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Alteração de Senha</h5>
                
                <!-- Mensagens -->
                <?php if (session()->getFlashdata('msgSucess')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('msgSucess') ?>
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('msgError')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('msgError') ?>
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <!-- Formulário -->
                <form method="POST" action="<?= base_url('trocar-senha/processar') ?>">
                    <?= csrf_field() ?>
                    
                    <div class="form-group">
                        <label for="senha_atual">Senha Atual</label>
                        <input type="password" 
                               class="form-control" 
                               id="senha_atual" 
                               name="senha_atual" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="senha_nova">Nova Senha</label>
                        <input type="password" 
                               class="form-control" 
                               id="senha_nova" 
                               name="senha_nova" 
                               placeholder="Mínimo 6 caracteres" 
                               required>
                    </div>

                    <div class="form-group">
                        <label for="confirma_senha">Confirmar Nova Senha</label>
                        <input type="password" 
                               class="form-control" 
                               id="confirma_senha" 
                               name="confirma_senha" 
                               required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Alterar Senha</button>
                        <a href="<?= base_url('admin/contatos') ?>" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>
