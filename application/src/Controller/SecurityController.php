<?php
namespace Main\Controller;

use E4u\Application\Controller\Security as E4uSecurity,
    E4u\Authentication\Exception,
    E4u\Application\View,
    E4u\Response,
    Main\Form\Security as Forms,
    Main\Model\User;

class SecurityController extends AbstractController implements E4uSecurity
{
    protected $requiredPrivileges = [ ];
    protected $defaultLayout = 'layout/security';

    public function loginAction()
    {
        $form = $this->loginForm();

        return [
            'title' => 'Zaloguj się',
            'form' => $form,
        ];
    }

    public function logoutAction()
    {
        $this->getAuthentication()->logout();
        return $this->redirectTo('/',
            "Zostałeś wylogowany.",
            View::FLASH_SUCCESS);
    }

    /**
     * @param  User $user
     * @return Response\Redirect
     */
    private function loginSuccess(User $user)
    {
        $message = sprintf(
            'Zalogowano jako <strong>%s</strong> (%s).',
            $user->getPreference('company') ?: $user->getName(), $user->getLogin());
        $this->getView()->addFlash($message, View::FLASH_SUCCESS);

        if (isset($_SESSION['redirect_to'])) {
            $redirect = $_SESSION['redirect_to'];
            unset($_SESSION['redirect_to']);
            return $this->redirectTo($redirect);
        }

        return $this->redirectBackOrTo('/');
    }

    private function loginForm()
    {
        $form = new Forms\Login($this->getRequest());

        if ($form->isValid()) {
            $values = $form->getValues();
            try {

                /** @var User $user */
                $user = $this->getAuthentication()->login($values['login'], $values['password'], $values['remember']);
                return $this->loginSuccess($user);

            }
            catch (Exception\UserNotActiveException $e) {
                $form->addError('Użytkownik jest nieaktywny. <strong>Skontaktuj się z działem obsługi klienta</strong>, aby aktywować konto.', 'password');
            }
            catch (Exception\AuthenticationException $e) {
                $form->addError('Nieprawidłowa nazwa użytkownika lub hasło.', 'password');
            }
        }

        return $form;
    }
}