<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use AppBundle\Form\DataTransformer\InvitationToCodeTransformer;

class InvitationFormType extends AbstractType
{
    private $invitationTransformer;

    public function __construct(InvitationToCodeTransformer $invitationTransformer)
    {
        $this->invitationTransformer = $invitationTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer($this->invitationTransformer);
    }

    // Or setDefaultOptions for Symfony 2.6 and older
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'class' => 'AppBundle\Entity\Invitation',
            'required' => true,
        ));
    }

    public function getParent()
    {
        return 'text';

        // Or for Symfony < 2.8
        // return 'text';
    }

    public function getBlockPrefix()
    {
        return 'app_invitation_type';
    }

    // Not necessary on Symfony 3+
    public function getName()
    {
        return 'app_invitation_type';
    }
}