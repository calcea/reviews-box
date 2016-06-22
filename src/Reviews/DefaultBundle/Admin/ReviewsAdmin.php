<?php

namespace Reviews\DefaultBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class ReviewsAdmin extends Admin
{
    protected $parentAssociationMapping = 'product';

    protected function configureListFields(ListMapper $list)
    {
        $list->add('review')
            ->add('user');
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('review')
            ->add('user');
    }
}