<?= $this->extend("layout\layoutHome") ?>

<?= $this->section("conteudo") ?>

<section class="mt-5">
    <div class="container">
        <div class="blog-banner">
            <div class="mt-5 mb-5 text-left">
                <h1 style="color: #384aeb;">Criar nova conta</h1>
            </div>
        </div>
    </div>
</section>

<section class="login_box_area section-margin mt-3 mb-5">
    <div class="container">
        <div class="row">

            <div class="col-lg-6">
                <div class="login_box_img">
                    <div class="hover">
                        <h4>Já possui uma conta?</h4>
                        <p>Acesse sua área pessoal para comentar, curtir e acompanhar nossas postagens.</p>
                        <a class="button button-account" href="<?= base_url() ?>login">Faça login aqui</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="login_form_inner">
                    <h3>Preencha seus dados</h3>

                    <form method="POST" class="row login_form" action="<?= base_url() ?>Usuario/store" id="registerForm">

                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="nome" name="nome"
                                placeholder="Nome completo" 
                                onfocus="this.placeholder=''" 
                                onblur="this.placeholder='Nome completo'"
                                value="<?= old('nome') ?>"
                                minlength="3"
                                maxlength="150"
                                required>
                        </div>

                        <div class="col-md-12 form-group">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="E-mail" 
                                onfocus="this.placeholder=''" 
                                onblur="this.placeholder='E-mail'"
                                value="<?= old('email') ?>"
                                maxlength="150"
                                required>
                        </div>

                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" id="senha" name="senha"
                                placeholder="Senha"
                                onfocus="this.placeholder=''" 
                                onblur="this.placeholder='Senha'"
                                minlength="6"
                                required>
                        </div>

                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" id="senha2" name="senha2"
                                placeholder="Confirmar senha"
                                onfocus="this.placeholder=''" 
                                onblur="this.placeholder='Confirmar senha'"
                                minlength="6"
                                required>
                        </div>

                        <div class="col-md-12 form-group">
                            <?= mensagemSucesso() ?>
                            <?= mensagemError() ?>
                        </div>

                        <div class="col-md-12 form-group">
                            <button type="submit" class="btn btn-secondary mr-3">Criar conta</button>
                            <a href="<?= base_url() ?>login">Voltar ao login</a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?= $this->endSection() ?>
