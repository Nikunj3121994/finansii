<?php
    class ConfigSeeder extends Seeder {

        public function run(){
            DB::table('field_configs')->delete();
            DB::table('fields')->delete();
            DB::table('form_configs')->delete();

            $municipalitiesForm=FormConfig::create(array('name'=>'municipalities','edit'=>1,'delete'=>1,'add'=>1));

            $municipalitiesForm->fields()->save(new Field(array(
                'name'=>'municipality_code',
                'label'=>'Code',
                'visible'=>1,
                'type'=>'number',
                'required'=>1,
                'edit'=>1
            )));
            $municipalitiesForm->fields()->save(new Field(array(
                'name'=>'municipality_name',
                'label'=>'Name',
                'visible'=>1,
                'type'=>'text',
                'required'=>1,
                'edit'=>1
            )));

            $settlementsForm=FormConfig::create(array('name'=>'settlements','edit'=>1,'delete'=>1,'add'=>1));
            $settlementsForm->fields()->save(new Field(array(
                'name'=>'settlement_code',
                'label'=>'Code',
                'visible'=>1,
                'type'=>'number',
                'required'=>1,
                'edit'=>1
            )));
            $settlementsForm->fields()->save(new Field(array(
                'name'=>'settlement_name',
                'label'=>'Name',
                'visible'=>1,
                'type'=>'text',
                'required'=>1,
                'edit'=>1
            )));
            $municipalitiesField=new Field(array(
                'name'=>'municipalities_code',
                'label'=>'Municipality',
                'visible'=>1,
                'type'=>'autocomplete',
                'required'=>1,
                'edit'=>1
            ));

            $settlementsForm->fields()->save($municipalitiesField);
            $municipalitiesField->property()->save(new FieldConfig(array(
                'key'=>'resource',
                'value'=>'municipalities',
            )));
            $municipalitiesField->property()->save(new FieldConfig(array(
                'key'=>'field',
                'value'=>'municipality_name',
            )));
            $municipalitiesField->property()->save(new FieldConfig(array(
                'key'=>'referencedColumn',
                'value'=>'municipality_code',
            )));



            $streetsForm=FormConfig::create(array('name'=>'streets','edit'=>1,'delete'=>1,'add'=>1));
            $streetsForm->fields()->save(new Field(array(
                'name'=>'street_code',
                'label'=>'Code',
                'visible'=>1,
                'type'=>'number',
                'required'=>1,
                'edit'=>1
            )));
            $streetsForm->fields()->save(new Field(array(
                'name'=>'street_name',
                'label'=>'Name',
                'visible'=>1,
                'type'=>'text',
                'required'=>1,
                'edit'=>1
            )));
            $settlementsField=new Field(array(
                'name'=>'settlement_code',
                'label'=>'Settlement',
                'visible'=>1,
                'type'=>'autocomplete',
                'required'=>1,
                'edit'=>1
            ));
            $streetsForm->fields()->save($settlementsField);
            $settlementsField->property()->save(new FieldConfig(array(
                'key'=>'resource',
                'value'=>'settlements'
            )));
            $settlementsField->property()->save(new FieldConfig(array(
                'key'=>'field',
                'value'=>'settlement_name'
            )));
            $settlementsField->property()->save(new FieldConfig(array(
                'key'=>'referencedColumn',
                'value'=>'settlement_code'
            )));

            $bankForm=FormConfig::create(array('name'=>'banks','edit'=>1,'delete'=>1,'add'=>1));
            $bankForm->fields()->save(new Field(array(
                'name'=>'bank_bic',
                'label'=>'Bank Code',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));
            $bankForm->fields()->save(new Field(array(
                'name'=>'bank_name',
                'label'=>'Name',
                'visible'=>1,
                'type'=>'text',
                'required'=>1,
                'edit'=>1
            )));
            $bankForm->fields()->save(new Field(array(
                'name'=>'bank_based',
                'label'=>'Location',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));
            $bankForm->fields()->save(new Field(array(
                'name'=>'bank_account',
                'label'=>'Account',
                'visible'=>1,
                'type'=>'number',
                'required'=>0,
                'edit'=>1
            )));
            $bankForm->fields()->save(new Field(array(
                'name'=>'bank_code',
                'label'=>'Code',
                'visible'=>1,
                'type'=>'number',
                'required'=>1,
                'edit'=>1
            )));
            $operatorsTable=FormConfig::create(array('name'=>'operators','edit'=>1,'delete'=>1,'add'=>1));
            $operatorsTable->fields()->save(new Field(array(
                'name'=>'operators_name',
                'label'=>'Name',
                'visible'=>1,
                'type'=>'text',
                'required'=>1,
                'edit'=>1
            )));
            $operatorsTable->fields()->save(new Field(array(
                'name'=>'operators_rang',
                'label'=>'Rang',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));
            $operatorsTable->fields()->save(new Field(array(
                'name'=>'operators_pass',
                'label'=>'Password',
                'visible'=>1,
                'type'=>'text',
                'required'=>1,
                'edit'=>1
            )));
            $operatorsTable->fields()->save(new Field(array(
                'name'=>'operators_telephone',
                'label'=>'Telephone',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));
            $operatorsTable->fields()->save(new Field(array(
                'name'=>'operators_telephone',
                'label'=>'Telephone',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));
            $operatorsTable->fields()->save(new Field(array(
                'name'=>'operators_mail',
                'label'=>'eMail',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));

            $companyTable=FormConfig::create(array('name'=>'operators','edit'=>1,'delete'=>1,'add'=>1));
            $companyTable->fields()->save(new Field(array(
                'name'=>'company_code',
                'label'=>'Code',
                'visible'=>1,
                'type'=>'number',
                'required'=>1,
                'edit'=>1
            )));
            $companyTable->fields()->save(new Field(array(
                'name'=>'company_name',
                'label'=>'Name',
                'visible'=>1,
                'type'=>'text',
                'required'=>1,
                'edit'=>1
            )));
            $companyTable->fields()->save(new Field(array(
                'name'=>'company_short_name',
                'label'=>'Short Name',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));
            $companyTable->fields()->save(new Field(array(
                'name'=>'company_address',
                'label'=>'Address',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));
            $municipalitiesField1=new Field(array(
                'name'=>'municipalities_code',
                'label'=>'Municipality',
                'visible'=>1,
                'type'=>'autocomplete',
                'required'=>1,
                'edit'=>1
            ));
            $companyTable->fields()->save($municipalitiesField1);
            $municipalitiesField1->property()->save(new FieldConfig(array(
                'key'=>'resource',
                'value'=>'municipalities',
            )));
            $municipalitiesField1->property()->save(new FieldConfig(array(
                'key'=>'field',
                'value'=>'municipality_name',
            )));
            $municipalitiesField1->property()->save(new FieldConfig(array(
                'key'=>'referencedColumn',
                'value'=>'municipality_code',
            )));

            $settlementsField1=new Field(array(
                'name'=>'settlement_code',
                'label'=>'Settlement',
                'visible'=>1,
                'type'=>'autocomplete',
                'required'=>1,
                'edit'=>1
            ));
            $companyTable->fields()->save($settlementsField1);
            $settlementsField1->property()->save(new FieldConfig(array(
                'key'=>'resource',
                'value'=>'settlements'
            )));
            $settlementsField1->property()->save(new FieldConfig(array(
                'key'=>'field',
                'value'=>'settlement_name'
            )));
            $settlementsField1->property()->save(new FieldConfig(array(
                'key'=>'referencedColumn',
                'value'=>'settlement_code'
            )));

            $streetsField=new Field(array(
                'name'=>'streets_code',
                'label'=>'Street',
                'visible'=>1,
                'type'=>'autocomplete',
                'required'=>1,
                'edit'=>1
            ));
            $companyTable->fields()->save($streetsField);
            $settlementsField1->property()->save(new FieldConfig(array(
                'key'=>'resource',
                'value'=>'streets'
            )));
            $settlementsField1->property()->save(new FieldConfig(array(
                'key'=>'field',
                'value'=>'street_name'
            )));
            $settlementsField1->property()->save(new FieldConfig(array(
                'key'=>'referencedColumn',
                'value'=>'street_code'
            )));
            $companyTable->fields()->save(new Field(array(
                'name'=>'telephone1',
                'label'=>'Telephone 1',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));
            $companyTable->fields()->save(new Field(array(
                'name'=>'telephone2',
                'label'=>'Telephone 2',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));
            $companyTable->fields()->save(new Field(array(
                'name'=>'fax',
                'label'=>'Fax',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));
            $companyTable->fields()->save(new Field(array(
                'name'=>'mail',
                'label'=>'Email',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));
            $companyTable->fields()->save(new Field(array(
                'name'=>'owner',
                'label'=>'Owner',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));
            $companyTable->fields()->save(new Field(array(
                'name'=>'authorized',
                'label'=>'Authorized',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));
            $companyTable->fields()->save(new Field(array(
                'name'=>'activity',
                'label'=>'Activity',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));
            $companyTable->fields()->save(new Field(array(
                'name'=>'id_number',
                'label'=>'Id number',
                'visible'=>1,
                'type'=>'number',
                'required'=>0,
                'edit'=>1
            )));
            $companyTable->fields()->save(new Field(array(
                'name'=>'tax_code',
                'label'=>'Tax code',
                'visible'=>1,
                'type'=>'number',
                'required'=>0,
                'edit'=>1
            )));
            $companyTable->fields()->save(new Field(array(
                'name'=>'tax_payer',
                'label'=>'Tax payer',
                'visible'=>1,
                'type'=>'number',
                'required'=>0,
                'edit'=>1
            )));

            $ordersTable=FormConfig::create(array('name'=>'orders','edit'=>1,'delete'=>1,'add'=>1));
            $ordersTable->fields()->save(new Field(array(
                'name'=>'order_type',
                'label'=>'Type',
                'visible'=>1,
                'type'=>'number',
                'required'=>1,
                'edit'=>1
            )));
            $ordersTable->fields()->save(new Field(array(
                'name'=>'order_number',
                'label'=>'Number',
                'visible'=>1,
                'type'=>'number',
                'required'=>1,
                'edit'=>1
            )));
            $ordersTable->fields()->save(new Field(array(
                'name'=>'order_date',
                'label'=>'Date',
                'visible'=>1,
                'type'=>'date',
                'required'=>1,
                'edit'=>1
            )));
            $ordersTable->fields()->save(new Field(array(
                'name'=>'order_booking',
                'label'=>'Booking',
                'visible'=>1,
                'type'=>'date',
                'required'=>1,
                'edit'=>1
            )));
            $operatorField=new Field(array(
                'name'=>'operator_id',
                'label'=>'Operator',
                'visible'=>1,
                'type'=>'date',
                'required'=>1,
                'edit'=>1
            ));
            $ordersTable->fields()->save($operatorField);
            $operatorField->property()->save(new FieldConfig(array(
                'key'=>'resource',
                'value'=>'operators'
            )));
            $operatorField->property()->save(new FieldConfig(array(
                'key'=>'field',
                'value'=>'operator_name'
            )));


            $subAccountsTable=FormConfig::create(array('name'=>'sub-accounts','edit'=>1,'delete'=>1,'add'=>1));
            $subAccountsTable->fields()->save(new Field(array(
                'name'=>'sub_account_code',
                'label'=>'Code',
                'visible'=>1,
                'type'=>'number',
                'required'=>1,
                'edit'=>1
            )));
            $subAccountsTable->fields()->save(new Field(array(
                'name'=>'sub_account_name',
                'label'=>'Name',
                'visible'=>1,
                'type'=>'text',
                'required'=>1,
                'edit'=>1
            )));
            $subAccountsTable->fields()->save(new Field(array(
                'name'=>'sub_account_table',
                'label'=>'Table',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));

            $accountsTable=FormConfig::create(array('name'=>'accounts','edit'=>1,'delete'=>1,'add'=>1));
            $accountsTable->fields()->save(new Field(array(
                'name'=>'account_name',
                'label'=>'Table',
                'visible'=>1,
                'type'=>'text',
                'required'=>1,
                'edit'=>1
            )));
            $accountsTable->fields()->save(new Field(array(
                'name'=>'account_type',
                'label'=>'Table',
                'visible'=>1,
                'type'=>'number',
                'required'=>1,
                'edit'=>1
            )));

            $subAccountsField=new Field(array(
                'name'=>'sub_account_code',
                'label'=>'Sub Account',
                'visible'=>1,
                'type'=>'number',
                'required'=>1,
                'edit'=>1
            ));
            $accountsTable->fields()->save($subAccountsField);
            $subAccountsField->property()->save(new FieldConfig(array(
                'key'=>'resource',
                'value'=>'sub-accounts'
            )));
            $subAccountsField->property()->save(new FieldConfig(array(
                'key'=>'field',
                'value'=>'sub_account_code'
            )));
            $subAccountsField->property()->save(new FieldConfig(array(
                'key'=>'referencedField',
                'value'=>'sub_account_code'
            )));

            $currenciesTable=FormConfig::create(array('name'=>'currencies','edit'=>1,'delete'=>1,'add'=>1));
            $currenciesTable->fields()->save(new Field(array(
                'name'=>'currency_shrt_name',
                'label'=>'Currency short name',
                'visible'=>1,
                'type'=>'text',
                'required'=>1,
                'edit'=>1
            )));
            $currenciesTable->fields()->save(new Field(array(
                'name'=>'currency_name',
                'label'=>'Currency name',
                'visible'=>1,
                'type'=>'text',
                'required'=>1,
                'edit'=>1
            )));
            $currenciesTable->fields()->save(new Field(array(
                'name'=>'currency_country',
                'label'=>'Currency Country',
                'visible'=>1,
                'type'=>'text',
                'required'=>1,
                'edit'=>1
            )));

            $exchangeRatesTable=FormConfig::create(array('name'=>'exchange-rates','edit'=>1,'delete'=>1,'add'=>1));
            $exchangeRatesTable->fields()->save(new Field(array(
                'name'=>'exchange_date',
                'label'=>'Exchange Date',
                'visible'=>1,
                'type'=>'date',
                'required'=>1,
                'edit'=>1
            )));
            $currencyField=new Field(array(
                'name'=>'currency_code',
                'label'=>'Currency',
                'visible'=>1,
                'type'=>'autocomplete',
                'required'=>1,
                'edit'=>1
            ));
            $exchangeRatesTable->fields()->save($currencyField);
            $currencyField->property()->save(new FieldConfig(array(
                'key'=>'resource',
                'value'=>'currencies'
            )));
            $currencyField->property()->save(new FieldConfig(array(
                'key'=>'field',
                'value'=>'currency_shrt_name'
            )));
            $exchangeRatesTable->fields()->save(new Field(array(
                'name'=>'currency_value',
                'label'=>'Currency value',
                'visible'=>1,
                'type'=>'number',
                'required'=>1,
                'edit'=>1
            )));

            $ledgersTable=FormConfig::create(array('name'=>'ledgers','edit'=>1,'delete'=>1,'add'=>1));
            $companyField=new Field(array(
                'name'=>'currency_value',
                'label'=>'Currency value',
                'visible'=>1,
                'type'=>'autocomplete',
                'required'=>1,
                'edit'=>1
            ));
            $ledgersTable->fields()->save($companyField);
            $companyField->property()->save(new FieldConfig(array(
                'key'=>'resource',
                'value'=>'companies'
            )));
            $companyField->property()->save(new FieldConfig(array(
                'key'=>'field',
                'value'=>'company_name'
            )));
            $companyField->property()->save(new FieldConfig(array(
                'key'=>'referencedColumn',
                'value'=>'company_name'
            )));

            $ledgersTable->fields()->save(new Field(array(
                'name'=>'account',
                'label'=>'Account',
                'visible'=>1,
                'type'=>'text',
                'required'=>1,
                'edit'=>1
            )));

            $accountField=new Field(array(
                'name'=>'sub_account',
                'label'=>'Account',
                'visible'=>1,
                'type'=>'autocomplete',
                'required'=>1,
                'edit'=>1
            ));
            $ledgersTable->fields()->save($accountField);
            $accountField->property()->save(new FieldConfig(array(
                'key'=>'resource',
                'value'=>'accounts'
            )));
            $accountField->property()->save(new FieldConfig(array(
                'key'=>'field',
                'value'=>'accounts_name'
            )));

            $ledgersTable->fields()->save(new Field(array(
                'name'=>'date',
                'label'=>'Date',
                'visible'=>1,
                'type'=>'date',
                'required'=>1,
                'edit'=>1
            )));
            $ledgersTable->fields()->save(new Field(array(
                'name'=>'document_number',
                'label'=>'Document number',
                'visible'=>1,
                'type'=>'number',
                'required'=>0,
                'edit'=>1
            )));
            $ledgersTable->fields()->save(new Field(array(
                'name'=>'date',
                'label'=>'document_desc',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));
            $ledgersTable->fields()->save(new Field(array(
                'name'=>'date',
                'label'=>'Date',
                'visible'=>1,
                'type'=>'date',
                'required'=>1,
                'edit'=>1
            )));
            $ledgersTable->fields()->save(new Field(array(
                'name'=>'booking_type',
                'label'=>'Booking type',
                'visible'=>1,
                'type'=>'number',
                'required'=>0,
                'edit'=>1
            )));
            $ledgersTable->fields()->save(new Field(array(
                'name'=>'amount',
                'label'=>'Amount',
                'visible'=>1,
                'type'=>'number',
                'required'=>1,
                'edit'=>1
            )));
            $currencyField1=new Field(array(
                'name'=>'currency_code',
                'label'=>'Currency',
                'visible'=>1,
                'type'=>'autocomplete',
                'required'=>1,
                'edit'=>1
            ));
            $ledgersTable->fields()->save($currencyField1);
            $currencyField1->property()->save(new FieldConfig(array(
                'key'=>'resource',
                'value'=>'currencies'
            )));
            $currencyField1->property()->save(new FieldConfig(array(
                'key'=>'field',
                'value'=>'currency_shrt_name'
            )));
            $ledgersTable->fields()->save(new Field(array(
                'name'=>'amount_currency',
                'label'=>'Amount currency',
                'visible'=>1,
                'type'=>'number',
                'required'=>1,
                'edit'=>1
            )));
        }
    }
