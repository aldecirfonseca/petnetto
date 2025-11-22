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
                    <span>Login <i class="ion-ios-arrow-forward"></i></span>
                </p>
                <h1 class="mb-0 bread">Área Administrativa</h1>
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
                        <h3 class="text-center mb-4">Login Administrativo</h3>
                        
                        <!-- Mensagens de Sucesso/Erro -->
                        <?php if (session()->getFlashdata('msgSucess')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('msgSucess') ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('msgError')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('msgError') ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>

                        <!-- Formulário de Login -->
                        <form method="POST" action="<?= base_url('login/processar') ?>">
                            <?= csrf_field() ?>
                            
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" 
                                       class="form-control" 
                                       id="email" 
                                       name="email" 
                                       placeholder="seu@email.com" 
                                       value="<?= old('email') ?>" 
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="senha">Senha</label>
                                <input type="password" 
                                       class="form-control" 
                                       id="senha" 
                                       name="senha" 
                                       placeholder="••••••" 
                                       required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                            </div>

                            <div class="text-center">
                                <a href="<?= base_url('esqueci-senha') ?>" class="text-muted">
                                    Esqueci minha senha
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
