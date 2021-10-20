<?php
class cardapioController extends Controller
{
    public function index()
    {
        $this->filtrarCardapio();
    }

    public function filtrarCardapio($filtro = 0)
    {
        $dados = array();
        $categorias = new Categoria();
        $dados['categorias'] = $categorias->getCategorias();
        $col = array_column($dados['categorias'], "cat_nome");
        array_multisort($col, SORT_ASC, $dados['categorias']);
        $item = new Item();
        if ($filtro == 0) {
            $dados['itens'] = $item->getItens();
            $dados['titulo'] = 'Cardápio - Todos os Itens';
        } else {
            $dados['itens'] = $item->filtrarCategoria($filtro);
            $dados['titulo'] = $categorias->getCategoriaItem($filtro);
            $dados['titulo'] = 'Cardápio - ' . $dados['titulo']['cat_nome'];
        }
        if (!empty($dados['itens'])) {

            foreach ($dados['itens'] as $key => $value) {
                if ($value['item_estoque'] == 0) {
                    $estoque[$key] = 0;
                } else {
                    $estoque[$key] = 1;
                }

            }

            array_multisort($estoque, SORT_DESC,
                array_column($dados['itens'], 'item_nome'), SORT_ASC,
                $dados['itens']);
        }

        $this->carregarTemplate('site/visualizarCardapio', $dados, 'site/templates/header', 'site/templates/footer');
    }
}
