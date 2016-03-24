<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1>Adicionar Produto</h1>
		</div>
	</div>
	<hr>
	<div class="row">
		<?php $this->flash( 'sucesso' ); ?>
		<?php $this->flash( 'erro	' ); ?>
		<form method="POST" id="adicionar_produto_form" action = "/produtos/adicionar_produto">
			<div class="form-group">
				<label for="nome_produto">Nome</label>
				<input type="text" class="form-control" name="nome_produto" id="nome_produto" placeholder="Nome">
			</div>
			<div class="form-group">
				<label for="descricao_produto">Descrição</label>
				<textarea class="form-control" rows="5" id="descricao_produto" name="descricao_produto" placeholder="Descrição do Produto"></textarea>
			</div>
			<div class="form-group">
				<label for="preco_produto">Preço</label>
				<div class="input-group">
					<div class="input-group-addon">$</div>
					<input type="text" name="preco_produto" class="form-control" id="preco_produto" placeholder="Preço">
				</div>
			</div>
			<div class="form-group">
				<input type="submit" name="submit" value="Enviar" class="btn btn-primary">
			</div>
		</form>
	</div>
</div>