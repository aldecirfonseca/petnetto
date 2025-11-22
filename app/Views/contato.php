<?= $this->extend("layout\layoutHome") ?>

<?= $this->section("conteudo") ?>

    <!-- Banner de Topo -->
    <section class="hero-wrap hero-wrap-2" style="background-image: url('<?= base_url("assets/images/bg_2.jpg") ?>');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs mb-2">
                        <span class="mr-2"><a href="<?= base_url() ?>">Home <i class="ion-ios-arrow-forward"></i></a></span>
                        <span>Contato <i class="ion-ios-arrow-forward"></i></span>
                    </p>
                    <h1 class="mb-0 bread">Entre em Contato</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Seção de Contato -->
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="wrapper px-md-4">
                        
                        <!-- Informações de Contato -->
                        <div class="row mb-5">
                            <div class="col-md-3">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-map-marker"></span>
                                    </div>
                                    <div class="text">
                                        <p><span>Endereço:</span> Muriaé, Minas Gerais, Brasil</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-phone"></span>
                                    </div>
                                    <div class="text">
                                        <p><span>Telefone:</span> <a href="tel://32372912345">(32) 3729-1234</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-paper-plane"></span>
                                    </div>
                                    <div class="text">
                                        <p><span>Email:</span> <a href="mailto:petnetto@gmail.com">petnetto@gmail.com</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-clock-o"></span>
                                    </div>
                                    <div class="text">
                                        <p><span>Horário:</span> Segunda a Sábado, 8h - 18h</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Formulário e Imagem -->
                        <div class="row no-gutters">
                            <div class="col-md-7">
                                <div class="contact-wrap w-100 p-md-5 p-4">
                                    <h3 class="mb-4">Envie sua mensagem</h3>
                                    
                                    <!-- Mensagens de Sucesso/Erro -->
                                    <?php if (session()->getFlashdata('msgSucess')): ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Sucesso!</strong> <?= session()->getFlashdata('msgSucess') ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (session()->getFlashdata('msgError')): ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <strong>Erro!</strong> <?= session()->getFlashdata('msgError') ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Formulário de Contato -->
                                    <form method="POST" action="<?= base_url('contato/enviar') ?>" id="contactForm" name="contactForm" class="contactForm">
                                        <?= csrf_field() ?>
                                        
                                        <div class="row">
                                            <!-- Campo Nome -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label" for="nome">Nome completo *</label>
                                                    <input type="text" 
                                                           class="form-control <?= isset(session('errors')['nome']) ? 'is-invalid' : '' ?>" 
                                                           name="nome" 
                                                           id="nome" 
                                                           placeholder="Seu nome" 
                                                           value="<?= old('nome') ?>" 
                                                           required>
                                                    <?php if (isset(session('errors')['nome'])): ?>
                                                        <div class="invalid-feedback d-block">
                                                            <?= session('errors')['nome'] ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <!-- Campo E-mail -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label" for="email">E-mail *</label>
                                                    <input type="email" 
                                                           class="form-control <?= isset(session('errors')['email']) ? 'is-invalid' : '' ?>" 
                                                           name="email" 
                                                           id="email" 
                                                           placeholder="seuemail@exemplo.com" 
                                                           value="<?= old('email') ?>" 
                                                           required>
                                                    <?php if (isset(session('errors')['email'])): ?>
                                                        <div class="invalid-feedback d-block">
                                                            <?= session('errors')['email'] ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <!-- Campo Assunto -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="label" for="assunto">Assunto *</label>
                                                    <input type="text" 
                                                           class="form-control <?= isset(session('errors')['assunto']) ? 'is-invalid' : '' ?>" 
                                                           name="assunto" 
                                                           id="assunto" 
                                                           placeholder="Assunto da mensagem" 
                                                           value="<?= old('assunto') ?>" 
                                                           required>
                                                    <?php if (isset(session('errors')['assunto'])): ?>
                                                        <div class="invalid-feedback d-block">
                                                            <?= session('errors')['assunto'] ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <!-- Campo Mensagem -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="label" for="mensagem">Mensagem *</label>
                                                    <textarea name="mensagem" 
                                                              class="form-control <?= isset(session('errors')['mensagem']) ? 'is-invalid' : '' ?>" 
                                                              id="mensagem" 
                                                              cols="30" 
                                                              rows="4" 
                                                              placeholder="Escreva sua mensagem aqui..." 
                                                              required><?= old('mensagem') ?></textarea>
                                                    <?php if (isset(session('errors')['mensagem'])): ?>
                                                        <div class="invalid-feedback d-block">
                                                            <?= session('errors')['mensagem'] ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <!-- Botão de Envio -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">Enviar Mensagem</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Imagem Lateral -->
                            <div class="col-md-5 d-flex align-items-stretch">
                                <div class="info-wrap w-100 p-5 img" style="background-image: url('<?= base_url("assets/images/about.jpg") ?>');">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>
