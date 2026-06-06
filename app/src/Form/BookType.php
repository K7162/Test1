<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Genre;
use App\Entity\Publisher;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Book form type.
 */
class BookType extends AbstractType
{
    /**
     * Build form.
     *
     * @param FormBuilderInterface $builder Form builder
     * @param array                $options Options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['label' => 'book.title'])
            ->add('totalPages', IntegerType::class, ['label' => 'book.total_pages'])
            ->add('publishedYear', IntegerType::class, ['label' => 'book.published_year'])
            ->add('genre', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'genre',
                'label' => 'book.genre',
            ])
            ->add('publisher', EntityType::class, [
                'class' => Publisher::class,
                'choice_label' => 'name',
                'label' => 'book.publisher',
            ])
            ->add('authors', EntityType::class, [
                'class' => Author::class,
                'choice_label' => fn (Author $a) => $a->getFirstName().' '.$a->getLastName(),
                'multiple' => true,
                'expanded' => false,
                'label' => 'book.authors',
            ]);
    }

    /**
     * Configure options.
     *
     * @param OptionsResolver $resolver Options resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Book::class]);
    }
}
