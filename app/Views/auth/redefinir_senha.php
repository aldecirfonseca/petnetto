<?= $this->extend("layout\layoutHome") ?>

<?= $this->section("conteudo") ?>

<section class="hero-wrap hero-wrap-2" style="background-image: url('<?= base_url("assets/images/bg_2.jpg") ?>');"
    data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end">
            <div class="col-md-9 ftco-animate pb-5">
                <p class="breadcrumbs mb-2">
                    <span class="mr-2"><a href="<?= base_url() ?>">Home <i class="ion-ios-arrow-forward"></i></a></span>
                    <span>Redefinir Senha <i class="ion-ios-arrow-forward"></i></span>
                </p>
                <h1 class="mb-0 bread">Redefinir Senha</h1>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card">
                    <div class="card-body p-5">
                        <h3 class="text-center mb-4">Nova Senha</h3>
                        
                        <p class="text-muted text-center">
                            Digite sua nova senha.
                        </p>

                        <!-- Mensagens -->
                        <?php if (session()->getFlashdata('msgError')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('msgError') ?>
                                <button type="button" class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <!-- Formulário -->
                        <form method="POST" action="<?= base_url('redefinir-senha/processar') ?>">
                            <?= csrf_field() ?>
                            <input type="hidden" name="token" value="<?= $token ?? '' ?>">
                            
                            <div class="form-group">
                                <label for="senha">Nova Senha</label>
                                <input type="password" 
                                       class="form-control" 
                                       id="senha" 
                                       name="senha" 
                                       placeholder="Mínimo 6 caracteres" 
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="confirma_senha">Confirmar Senha</label>
                                <input type="password" 
                                       class="form-control" 
                                       id="confirma_senha" 
                                       name="confirma_senha" 
                                       placeholder="Digite a senha novamente" 
                                       required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Redefinir Senha</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
