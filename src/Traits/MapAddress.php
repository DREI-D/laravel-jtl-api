<?php

namespace DREID\LaravelJtlApi\Traits;

trait MapAddress
{
    protected function mapAddress($address): ?array
    {
        return $address ? [
            'company'           => $address->company,
            'company2'          => $address->company2,
            'formOfAddress'     => $address->formOfAddress,
            'title'             => $address->title,
            'firstName'         => $address->firstName,
            'lastName'          => $address->lastName,
            'street'            => $address->street,
            'address2'          => $address->address2,
            'postalCode'        => $address->postalCode,
            'city'              => $address->city,
            'state'             => $address->state,
            'countryIso'        => $address->countryIso,
            'vatID'             => $address->vatId,
            'phoneNumber'       => $address->phoneNumber,
            'mobilePhoneNumber' => $address->mobilePhoneNumber,
            'emailAddress'      => $address->emailAddress,
            'fax'               => $address->fax,
        ] : null;
    }
}
