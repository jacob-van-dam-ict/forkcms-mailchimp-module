<?php

namespace Frontend\Modules\Mailchimp\Ajax;

use Backend\Modules\Mailchimp\Domain\Subscribe\Event\Subscribed;
use Backend\Modules\Mailchimp\Domain\Subscribe\SubscribeDataTransferObject;
use Backend\Modules\Mailchimp\Domain\Subscribe\SubscribeType;
use Frontend\Core\Engine\Base\AjaxAction as FrontendBaseAJAXAction;
use Frontend\Core\Language\Language;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Response;

/**
 * This is the subscribe-action, it will subscribe a user to the mailinglist
 *
 * @author John Poelman <john.poelman@bloobz.be>
 * @author Jacob van Dam <j.vandam@jvdict.nl>
 */
class Subscription extends FrontendBaseAJAXAction
{
    /**
     * {@inheritdoc}
     */
    public function execute(): void
    {
        parent::execute();

        $form = $this->getForm();

        if (!$form->isSubmitted() || !$form->isValid()) {
            $this->output(
                Response::HTTP_BAD_REQUEST,
                [
                    'errors' => $this->getFormErrors($form),
                ]
            );

            return;
        }

        $this->get('event_dispatcher')->dispatch(
            Subscribed::EVENT_NAME,
            new Subscribed($form->getData())
        );


        $this->output(
            Response::HTTP_OK,
            [
                'message' => Language::getMessage('Subscribed'),
            ]
        );
    }

    private function getForm(): Form
    {
        // Load our form
        $form = $this->createForm(
            SubscribeType::class,
            new SubscribeDataTransferObject()
        );

        // Assign current request to form
        $form->handleRequest($this->getRequest());

        return $form;
    }

    private function getFormErrors(Form $form): array
    {
        $errors = [];

        foreach ($form->all() as $field) {
            $errors[$field->getName()] = [];
            foreach ($field->getErrors() as $error) {
                $errors[$field->getName()][] = $error->getMessage();
            }
        }

        return $errors;
    }

    /**
     * Creates and returns a Form instance from the type of the form.
     *
     * @param string $type FQCN of the form type class i.e: MyClass::class
     * @param mixed $data The initial data for the form
     * @param array $options Options for the form
     *
     * @return Form
     */
    private function createForm(string $type, $data = null, array $options = []): Form
    {
        return $this->get('form.factory')->create($type, $data, $options);
    }
}
