<?php if (!empty($product['Children'])) : ?>
    <div class="children">
    <?php foreach ($product['Children'] as $child) : ?>
        <?php echo $this->element('Products.product', array('product' => array('Product' => $child))); ?>
    <?php endforeach; ?>
    </div>
<?php else : ?>
    <?php echo $this->element('Products.product', array('product' => $product)); ?>
<?php endif; ?>

<script type="text/javascript">
    $(function() {
        $('.children .product.view').hide();
        $('.children .product.view:first-child').show();
        $('.ProductSelectId').removeAttr('disabled');
        $('.ProductSelectId').change(function() {
            $('.children .product.view').hide();
            $('#ProductSelectId' + $(this).val()).val($(this).val());
            $('#product' + $(this).val()).show();
        });
    });
</script>
<?php
// set the contextual breadcrumb items
$this->set('context_crumbs', array('crumbs' => array(
	$this->Html->link(__('All Products'), '/products'),
	$product['Product']['name']
)));

// set contextual search options
$this->set('forms_search', array(
    'url' => '/products/products/index/', 
	'inputs' => array(
		array(
			'name' => 'contains:name', 
			'options' => array(
				'label' => '', 
				'placeholder' => 'Product Search',
				'value' => !empty($this->request->params['named']['contains']) ? substr($this->request->params['named']['contains'], strpos($this->request->params['named']['contains'], ':') + 1) : null,
				)
			),
		)
	));

// set the contextual menu items
$this->set('context_menu', array('menus' => array(
    array(
		'heading' => 'Products',
		'items' => array(
			$this->Html->link(__('Dashboard'), array('admin' => true, 'controller' => 'products', 'action' => 'dashboard')),
			$this->Html->link(__('Cart'), array('plugin' => 'transactions', 'controller' => 'transactions', 'action' => 'cart')),
			)
		),
	array(
		'heading' => 'Product',
		'items' => array(
			$this->Html->link(__d('products', 'List'), array('action' => 'index')),
			$this->Html->link(__d('products', 'Edit'), array('action' => 'edit', $product['Product']['id'])),
			$this->Html->link(__d('products', 'Delete'), array('action' => 'delete', $product['Product']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $product['Product']['id'])),
			),
		),
	)));
