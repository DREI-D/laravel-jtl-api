<?php

namespace DREID\LaravelJtlApi\Traits;

trait MapAddress
{
    protected function mapAddress($address): ?array
    {
        return $address ? [
            'Company'           => $address->company,
            'Company2'          => $address->company2,
            'FormOfAddress'     => $address->formOfAddress,
            'Title'             => $address->title,
            'FirstName'         => $address->firstName,
            'LastName'          => $address->lastName,
            'Street'            => $address->street,
            'Address2'          => $address->address2,
            'PostalCode'        => $address->postalCode,
            'City'              => $address->city,
            'State'             => $address->state,
            'CountryIso'        => $address->countryIso,
            'VatID'             => $address->vatId,
            'PhoneNumber'       => $address->phoneNumber,
            'MobilePhoneNumber' => $address->mobilePhoneNumber,
            'EmailAddress'      => $address->emailAddress,
            'Fax'               => $address->fax,
        ] : null;
    }
}
