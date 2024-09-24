<?php
declare(strict_types=1);

namespace EdmondsCommerce\MultiplicationTables\Model\Product\Attribute\Backend;

use EdmondsCommerce\MultiplicationTables\Exceptions\MultiplicationXValueMustBePositiveException;
use EdmondsCommerce\MultiplicationTables\Exceptions\MultiplicationYValueMustBePositiveException;
use EdmondsCommerce\MultiplicationTables\Services\MultiplicationValueValidator;
use EdmondsCommerce\MultiplicationTables\Services\MultiplicationValueValidatorInterface;
use Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend;
use Magento\Framework\Exception\LocalizedException;

class MultiplicationValue extends AbstractBackend
{
    private MultiplicationValueValidatorInterface $customValidator;
    private bool $skipParentValidation = false;

    public function __construct()
    {
        $this->customValidator = new MultiplicationValueValidator();
    }

    //Method just for testing, specifically injecting an alternative validator, abit smelly but I don't *think* I have control over
    //how magento calls the backend class for attributes.
    public function setValidator(MultiplicationValueValidatorInterface $validator)
    {
        $this->customValidator = $validator;
    }

    public function setSkipParentValidation()
    {
        $this->skipParentValidation = true;
    }

    public function validate($object)
    {
        if(!$this->skipParentValidation) {
            parent::validate($object);
        }

        if($this->isNullOrEmptyString($object->getData('x_axis')) && $this->isNullOrEmptyString($object->getData('y_axis'))){
            return;
        }

        try {
            $value = new \EdmondsCommerce\MultiplicationTables\Values\MultiplicationValue((int)$object->getData('x_axis'), (int)$object->getData('y_axis'));
            $this->customValidator->validate($value);
        }catch (MultiplicationXValueMustBePositiveException|MultiplicationYValueMustBePositiveException $exception){
            throw new LocalizedException(__($exception->getMessage()));
        }
    }

    private function isNullOrEmptyString($value)
    {
        return $value === null || $value === '';
    }
}
