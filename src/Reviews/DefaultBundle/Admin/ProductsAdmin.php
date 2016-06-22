<?php

namespace Reviews\DefaultBundle\Admin;

use Knp\Menu\ItemInterface;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProductsAdmin extends Admin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('productId')
            ->add('code')
            ->add('name')
            ->add('description')
            ->add('manufacturer')
            ->add('deleted');
    }

    protected function configureListFields(ListMapper $list)
    {
        $list->addIdentifier('code')
            ->add('name')
            ->add('description')
            ->add('manufacturer')
            ->add('deleted');
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('code')
            ->add('name')
            ->add('manufacturer');
    }

    public function configureSideMenu(ItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
//        if (!$childAdmin && !in_array($action, array('edit', 'show'))) { return; }

        $admin = $this->isChild() ? $this->getParent() : $this;
        $id = $admin->getRequest()->get('id');
        if(!is_null($id)){
            $menu->addChild('Reviews', array('uri' => $admin->generateUrl('review_admin.list', array('id' => $id))));
        }

    }
}