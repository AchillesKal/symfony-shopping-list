<?php

namespace App\Security;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use App\Entity\ShoppingList;
use App\Entity\User;

class ShoppingListVoter extends Voter
{
    const VIEW = 'view';
    const EDIT = 'edit';

    protected function supports($attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, array(self::VIEW, self::EDIT))) {
            return false;
        }

        // only vote on Post objects inside this voter
        if (!$subject instanceof ShoppingList) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        // you know $subject is a Post object, thanks to supports
        /** @var ShoppingList $shoppingList */
        $shoppingList = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($shoppingList, $user);
            case self::EDIT:
                return $this->canEdit($shoppingList, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(ShoppingList $shoppingList, User $user)
    {
        // if they can edit, they can view
        if ($this->canEdit($shoppingList, $user)) {
            return true;
        }

        return false;
    }

    private function canEdit(ShoppingList $shoppingList, User $user)
    {
        // this assumes that the data object has a getOwner() method
        // to get the entity of the user who owns this data object
        return $user === $shoppingList->getOwner();
    }

}