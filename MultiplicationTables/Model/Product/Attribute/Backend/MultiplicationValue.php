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

    public function validate($object)
    {
        try {
            $value = new \EdmondsCommerce\MultiplicationTables\Values\MultiplicationValue($object->getData('x_axis'), $object->getData('y_axis'));
            $this->customValidator->validate($value);
        }catch (MultiplicationXValueMustBePositiveException|MultiplicationYValueMustBePositiveException $exception){
            throw new LocalizedException(__($exception->getMessage()));
        }
    }
}
