<?= $this->extend("layout/layoutSistema") ?>
<?= $this->section("conteudo") ?>

<section class="mt-5">
    <div class="container">
        <div class="blog-banner mt-5 mb-4">
            <h1 style="color: #384aeb;">Meu Perfil</h1>
        </div>

        <div class="col-md-12 form-group">
            <?= mensagemSucesso() ?>
            <?= mensagemError() ?>
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">

                <div class="card p-4 shadow h-100">
                    <h4 class="mb-4">Informações da Conta</h4>

                    <p><strong>Nome:</strong> <?= esc($usuario['nome']) ?></p>
                    <p><strong>E-mail:</strong> <?= esc($usuario['email']) ?></p>

                    <a href="<?= base_url('Usuario/trocarSenha') ?>" class="button button-account mt-3">
                        Trocar senha
                    </a>

                    <form method="POST"
                        action="<?= base_url('Usuario/softDelete') ?>"
                        class="mt-3">

                        <button type="submit"
                                class="btn btn-danger"
                                onclick="return confirm('Tem certeza que deseja excluir sua conta? Você não poderá mais fazer login!')">
                            Deletar minha conta
                        </button>
                    </form>
                </div>

            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <?php if (session()->getTempData('userNivel') == 2): ?>
                    <div class="card p-4 shadow h-100">
                        <h4 class="mb-4">Administração</h4>

                        <a href="<?= base_url('/UsuarioAdm') ?>" class="btn btn-warning">
                            Gerenciar Usuários
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
