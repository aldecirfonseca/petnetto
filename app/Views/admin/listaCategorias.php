    <?php $this->extend('layout/layoutSistema'); ?>

    <?php $this->section('conteudo'); ?>

    <?= exibeTitulo("Veterinarios", ['acao' => $action]) ?>

    <?= form_open_multipart('Veterinarios/' . $action) ?>

            <table id="table" class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Especialidade</th>
                        <th>Editada em</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($Veterinarios as $vet): ?>
                    <tr>
                        <td><?= esc($vet['id']) ?></td>
                        <td><?= esc($vet['nome']) ?></td>
                        <td><?= esc($vet['especialidade']) ?></td>
                        <td><?= date('d/m/Y', strtotime($vet['updated_at'])) ?></td>
                        <td>
                        <a href="<?= base_url('Veterinarios/form/editar/' . $vet['id']) ?>" 
                        class="btn btn-warning">Editar</a>
                            <form action="<?= base_url('Veterinarios/delete') ?>" method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $vet['id'] ?>">
                                <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Tem certeza que deseja excluir este registro?')">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tfoot>
                <tr></tr>
                </tfoot>
            </table>

            <a href="<?= base_url('/') ?>" class="btn btn-outline-secondary">Voltar</a>

            <script>

                let table = new DataTable('#table');

            </script>
            
    <?php $this->endSection() ?>