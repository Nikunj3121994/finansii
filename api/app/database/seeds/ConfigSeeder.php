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
                'name'=>'municipality_code',
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
                'name'=>'operator_name',
                'label'=>'Name',
                'visible'=>1,
                'type'=>'text',
                'required'=>1,
                'edit'=>1
            )));
            $operatorsTable->fields()->save(new Field(array(
                'name'=>'operator_rang',
                'label'=>'Rang',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));
            $operatorsTable->fields()->save(new Field(array(
                'name'=>'operator_pass',
                'label'=>'Password',
                'visible'=>1,
                'type'=>'text',
                'required'=>1,
                'edit'=>1
            )));
            $operatorsTable->fields()->save(new Field(array(
                'name'=>'operator_telephone',
                'label'=>'Telephone',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));
            $operatorsTable->fields()->save(new Field(array(
                'name'=>'operator_mail',
                'label'=>'eMail',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));

            $companyTable=FormConfig::create(array('name'=>'companies','edit'=>1,'delete'=>1,'add'=>1));
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
                'name'=>'municipality_code',
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
            $settlementsField1->property()->save(new FieldConfig(array(
                'key'=>'dependencyModel',
                'value'=>'municipalities'
            )));
            $settlementsField1->property()->save(new FieldConfig(array(
                'key'=>'dependencyField',
                'value'=>'municipality_code'
            )));

            $streetsField=new Field(array(
                'name'=>'street_code',
                'label'=>'Street',
                'visible'=>1,
                'type'=>'autocomplete',
                'required'=>1,
                'edit'=>1
            ));
            $companyTable->fields()->save($streetsField);
            $streetsField->property()->save(new FieldConfig(array(
                'key'=>'resource',
                'value'=>'streets'
            )));
            $streetsField->property()->save(new FieldConfig(array(
                'key'=>'field',
                'value'=>'street_name'
            )));
            $streetsField->property()->save(new FieldConfig(array(
                'key'=>'referencedColumn',
                'value'=>'street_code'
            )));
            $streetsField->property()->save(new FieldConfig(array(
                'key'=>'dependencyModel',
                'value'=>'settlements'
            )));
            $streetsField->property()->save(new FieldConfig(array(
                'key'=>'dependencyField',
                'value'=>'settlement_code'
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
            $companyField1=new Field(array(
                'name'=>'company_code',
                'label'=>'Company',
                'visible'=>1,
                'type'=>'autocomplete',
                'required'=>1,
                'edit'=>1
            ));
            $ordersTable->fields()->save($companyField1);
            $companyField1->property()->save(new FieldConfig(array(
                'key'=>'resource',
                'value'=>'companies'
            )));
            $companyField1->property()->save(new FieldConfig(array(
                'key'=>'field',
                'value'=>'company_name'
            )));
            $companyField1->property()->save(new FieldConfig(array(
                'key'=>'referencedColumn',
                'value'=>'company_code'
            )));


            $subAccountsTable=FormConfig::create(array('name'=>'sub_accounts','edit'=>1,'delete'=>1,'add'=>1));
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
                'label'=>'Name',
                'visible'=>1,
                'type'=>'text',
                'required'=>1,
                'edit'=>1
            )));
            $accountsTable->fields()->save(new Field(array(
                'name'=>'account_type',
                'label'=>'Type',
                'visible'=>1,
                'type'=>'number',
                'required'=>1,
                'edit'=>1
            )));

            $subAccountsField=new Field(array(
                'name'=>'sub_account_code',
                'label'=>'Sub Account',
                'visible'=>1,
                'type'=>'autocomplete',
                'required'=>1,
                'edit'=>1
            ));
            $accountsTable->fields()->save($subAccountsField);
            $subAccountsField->property()->save(new FieldConfig(array(
                'key'=>'resource',
                'value'=>'sub_accounts'
            )));
            $subAccountsField->property()->save(new FieldConfig(array(
                'key'=>'field',
                'value'=>'sub_account_name'
            )));
            $subAccountsField->property()->save(new FieldConfig(array(
                'key'=>'referencedColumn',
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

            $exchangeRatesTable=FormConfig::create(array('name'=>'exchange_rates','edit'=>1,'delete'=>1,'add'=>1));
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
            $accountField=new Field(array(
                'name'=>'account',
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
                'value'=>'account_name'
            )));
            $subAccountField=new Field(array(
                'name'=>'sub_account',
                'label'=>'Sub Account',
                'visible'=>1,
                'type'=>'autocomplete',
                'required'=>1,
                'edit'=>1
            ));
            $ledgersTable->fields()->save($subAccountField);
            $subAccountField->property()->save(new FieldConfig(array(
                'key'=>'resource',
                'value'=>'sub_accounts'
            )));
            $subAccountField->property()->save(new FieldConfig(array(
                'key'=>'field',
                'value'=>'name'
            )));
            $subAccountField->property()->save(new FieldConfig(array(
                'key'=>'referencedColumn',
                'value'=>'code'
            )));
            $subAccountField->property()->save(new FieldConfig(array(
                'key'=>'dependencyModel',
                'value'=>'accounts'
            )));
            $subAccountField->property()->save(new FieldConfig(array(
                'key'=>'dependencyField',
                'value'=>'sub_account_code'
            )));

            $ledgersTable->fields()->save(new Field(array(
                'name'=>'document_desc',
                'label'=>'Document Description',
                'visible'=>1,
                'type'=>'text',
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
                'name'=>'document_date',
                'label'=>'Document date',
                'visible'=>1,
                'type'=>'date',
                'required'=>0,
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
            $amountField=new Field(array(
                'name'=>'amount',
                'label'=>'Amount',
                'visible'=>1,
                'type'=>'dependency',
                'required'=>1,
                'edit'=>1
            ));
            $ledgersTable->fields()->save($amountField);
            $amountField->property()->save(new FieldConfig(array(
                'key'=>'mathFunction',
                'value'=>'{"formula":"mul","funcArgs":{"val1":"amount_currency","val2":"currency_value"}}'
            )));
            $amountField->property()->save(new FieldConfig(array(
                'key'=>'watches',
                'value'=>'["formData.amount_currency"]'
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
            $currencyField1->property()->save(new FieldConfig(array(
                'key'=>'dependencyModel',
                'value'=>'document_date'
            )));
            $currencyField1->property()->save(new FieldConfig(array(
                'key'=>'dependencyField',
                'value'=>'document_date'
            )));
            $amountCurrency=new Field(array(
                'name'=>'amount_currency',
                'label'=>'Amount currency',
                'visible'=>1,
                'type'=>'dependency',
                'required'=>1,
                'edit'=>1
            ));
            $ledgersTable->fields()->save($amountCurrency);
            $amountCurrency->property()->save(new FieldConfig(array(
                'key'=>'mathFunction',
                'value'=>'{"formula":"divSameVal","funcArgs":{"val1":"amount","val2":"currency_value"}}'
            )));
            $amountCurrency->property()->save(new FieldConfig(array(
                'key'=>'watches',
                'value'=>'["formData.amount","formData.currencies"]'
            )));

            $tariffTable=FormConfig::create(array('name'=>'tariffs','edit'=>1,'delete'=>1,'add'=>1));
            $tariffTable->fields()->save(new Field(array(
                'name'=>'tariff_code',
                'label'=>'Tariff code',
                'visible'=>1,
                'type'=>'number',
                'required'=>1,
                'edit'=>1
            )));
            $tariffTable->fields()->save(new Field(array(
                'name'=>'tariff_rate',
                'label'=>'Tariff rate',
                'visible'=>1,
                'type'=>'text',
                'required'=>1,
                'edit'=>1
            )));
            $tariffTable->fields()->save(new Field(array(
                'name'=>'tariff_name',
                'label'=>'Tariff name',
                'visible'=>1,
                'type'=>'text',
                'required'=>1,
                'edit'=>1
            )));
            $unitsTable=FormConfig::create(array('name'=>'units','edit'=>1,'delete'=>1,'add'=>1));
            $unitsTable->fields()->save(new Field(array(
                'name'=>'unit_name',
                'label'=>'Unit name',
                'visible'=>1,
                'type'=>'text',
                'required'=>1,
                'edit'=>1
            )));
            $unitsTable->fields()->save(new Field(array(
                'name'=>'unit_desc',
                'label'=>'Unit description',
                'visible'=>1,
                'type'=>'text',
                'required'=>1,
                'edit'=>1
            )));
            $articlesTable=FormConfig::create(array('name'=>'articles','edit'=>1,'delete'=>1,'add'=>1));
            $articlesTable->fields()->save(new Field(array(
                'name'=>'article_name',
                'label'=>'Name',
                'visible'=>1,
                'type'=>'text',
                'required'=>1,
                'edit'=>1
            )));
            $tariffField=new Field(array(
                'name'=>'tariff_code',
                'label'=>'Tariff',
                'visible'=>1,
                'type'=>'autocomplete',
                'required'=>1,
                'edit'=>1
            ));
            $articlesTable->fields()->save($tariffField);
            $tariffField->property()->save(new FieldConfig(array(
                'key'=>'field',
                'value'=>'tariff_name'
            )));
            $tariffField->property()->save(new FieldConfig(array(
                'key'=>'resource',
                'value'=>'tariffs'
            )));
            $tariffField->property()->save(new FieldConfig(array(
                'key'=>'referencedColumn',
                'value'=>'tariff_code'
            )));

            $unitField=new Field(array(
                'name'=>'unit_id',
                'label'=>'Unit',
                'visible'=>1,
                'type'=>'autocomplete',
                'required'=>1,
                'edit'=>1
            ));
            $articlesTable->fields()->save($unitField);
            $unitField->property()->save(new FieldConfig(array(
                'key'=>'field',
                'value'=>'unit_name'
            )));
            $unitField->property()->save(new FieldConfig(array(
                'key'=>'resource',
                'value'=>'units'
            )));
            $articlesTable->fields()->save(new Field(array(
                'name'=>'pack',
                'label'=>'Pack',
                'visible'=>1,
                'type'=>'number',
                'required'=>1,
                'edit'=>1
            )));

            $businessUnitsTable=FormConfig::create(array('name'=>'business_units','edit'=>1,'delete'=>1,'add'=>1));
            $companyFieldBU=new Field(array(
                'name'=>'company_code',
                'label'=>'Company',
                'visible'=>1,
                'type'=>'autocomplete',
                'required'=>1,
                'edit'=>1
            ));
            $businessUnitsTable->fields()->save($companyFieldBU);
            $companyFieldBU->property()->save(new FieldConfig(array(
                'key'=>'resource',
                'value'=>'companies'
            )));
            $companyFieldBU->property()->save(new FieldConfig(array(
                'key'=>'field',
                'value'=>'company_code'
            )));
            $companyFieldBU->property()->save(new FieldConfig(array(
                'key'=>'referencedColumn',
                'value'=>'company_code'
            )));
            $businessUnitsTable->fields()->save(new Field(array(
                'name'=>'business_unit_code',
                'label'=>'Code',
                'visible'=>1,
                'type'=>'number',
                'required'=>1,
                'edit'=>1
            )));
            $businessUnitsTable->fields()->save(new Field(array(
                'name'=>'business_unit_name',
                'label'=>'Name',
                'visible'=>1,
                'type'=>'text',
                'required'=>1,
                'edit'=>1
            )));
            $businessUnitsTable->fields()->save(new Field(array(
                'name'=>'business_unit_type',
                'label'=>'Type',
                'visible'=>1,
                'type'=>'number',
                'required'=>1,
                'edit'=>1
            )));
            $businessUnitsTable->fields()->save(new Field(array(
                'name'=>'business_unit_account',
                'label'=>'Account',
                'visible'=>1,
                'type'=>'text',
                'required'=>1,
                'edit'=>1
            )));
            $businessUnitsTable->fields()->save(new Field(array(
                'name'=>'business_unit_address',
                'label'=>'Address',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));


            $partnersTable=FormConfig::create(array('name'=>'partners','edit'=>1,'delete'=>1,'add'=>1));
            $partnersTable->fields()->save(new Field(array(
                'name'=>'partner_code',
                'label'=>'Code',
                'visible'=>1,
                'type'=>'number',
                'required'=>1,
                'edit'=>1
            )));
            $partnersTable->fields()->save(new Field(array(
                'name'=>'partner_name',
                'label'=>'Name',
                'visible'=>1,
                'type'=>'text',
                'required'=>1,
                'edit'=>1
            )));

            $partnersTable->fields()->save(new Field(array(
                'name'=>'partner_address',
                'label'=>'Address',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));
            $municipalitiesFieldP=new Field(array(
                'name'=>'municipality_code',
                'label'=>'Municipality',
                'visible'=>1,
                'type'=>'autocomplete',
                'required'=>1,
                'edit'=>1
            ));
            $partnersTable->fields()->save($municipalitiesFieldP);
            $municipalitiesFieldP->property()->save(new FieldConfig(array(
                'key'=>'resource',
                'value'=>'municipalities',
            )));
            $municipalitiesFieldP->property()->save(new FieldConfig(array(
                'key'=>'field',
                'value'=>'municipality_name',
            )));
            $municipalitiesFieldP->property()->save(new FieldConfig(array(
                'key'=>'referencedColumn',
                'value'=>'municipality_code',
            )));

            $settlementsFieldP=new Field(array(
                'name'=>'settlement_code',
                'label'=>'Settlement',
                'visible'=>1,
                'type'=>'autocomplete',
                'required'=>1,
                'edit'=>1
            ));
            $partnersTable->fields()->save($settlementsFieldP);
            $settlementsFieldP->property()->save(new FieldConfig(array(
                'key'=>'resource',
                'value'=>'settlements'
            )));
            $settlementsFieldP->property()->save(new FieldConfig(array(
                'key'=>'field',
                'value'=>'settlement_name'
            )));
            $settlementsFieldP->property()->save(new FieldConfig(array(
                'key'=>'referencedColumn',
                'value'=>'settlement_code'
            )));
            $settlementsFieldP->property()->save(new FieldConfig(array(
                'key'=>'dependencyModel',
                'value'=>'municipalities'
            )));
            $settlementsFieldP->property()->save(new FieldConfig(array(
                'key'=>'dependencyField',
                'value'=>'municipality_code'
            )));

            $streetsFieldP=new Field(array(
                'name'=>'street_code',
                'label'=>'Street',
                'visible'=>1,
                'type'=>'autocomplete',
                'required'=>1,
                'edit'=>1
            ));
            $partnersTable->fields()->save($streetsFieldP);
            $streetsFieldP->property()->save(new FieldConfig(array(
                'key'=>'resource',
                'value'=>'streets'
            )));
            $streetsFieldP->property()->save(new FieldConfig(array(
                'key'=>'field',
                'value'=>'street_name'
            )));
            $streetsFieldP->property()->save(new FieldConfig(array(
                'key'=>'referencedColumn',
                'value'=>'street_code'
            )));
            $streetsFieldP->property()->save(new FieldConfig(array(
                'key'=>'dependencyModel',
                'value'=>'settlements'
            )));
            $streetsFieldP->property()->save(new FieldConfig(array(
                'key'=>'dependencyField',
                'value'=>'settlement_code'
            )));
            $partnersTable->fields()->save(new Field(array(
                'name'=>'telephone1',
                'label'=>'Telephone 1',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));
            $partnersTable->fields()->save(new Field(array(
                'name'=>'telephone2',
                'label'=>'Telephone 2',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));
            $partnersTable->fields()->save(new Field(array(
                'name'=>'fax',
                'label'=>'Fax',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));
            $partnersTable->fields()->save(new Field(array(
                'name'=>'mail',
                'label'=>'Email',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));
            $partnersTable->fields()->save(new Field(array(
                'name'=>'owner',
                'label'=>'Owner',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));
            $partnersTable->fields()->save(new Field(array(
                'name'=>'authorized',
                'label'=>'Authorized',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));
            $partnersTable->fields()->save(new Field(array(
                'name'=>'activity',
                'label'=>'Activity',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));
            $partnersTable->fields()->save(new Field(array(
                'name'=>'id_number',
                'label'=>'Id number',
                'visible'=>1,
                'type'=>'number',
                'required'=>0,
                'edit'=>1
            )));
            $partnersTable->fields()->save(new Field(array(
                'name'=>'tax_code',
                'label'=>'Tax code',
                'visible'=>1,
                'type'=>'number',
                'required'=>0,
                'edit'=>1
            )));
            $partnersTable->fields()->save(new Field(array(
                'name'=>'tax_payer',
                'label'=>'Tax payer',
                'visible'=>1,
                'type'=>'number',
                'required'=>0,
                'edit'=>1
            )));

            $calculationTypesTable=FormConfig::create(array('name'=>'calculation_types','edit'=>1,'delete'=>1,'add'=>1));
            $calculationTypesTable->fields()->save(new Field(array(
                'name'=>'calculation_type_code',
                'label'=>'Code',
                'visible'=>1,
                'type'=>'number',
                'required'=>0,
                'edit'=>1
            )));
            $calculationTypesTable->fields()->save(new Field(array(
                'name'=>'calculation_type_name',
                'label'=>'Name',
                'visible'=>1,
                'type'=>'text',
                'required'=>0,
                'edit'=>1
            )));

            $calculationHeaderTable=FormConfig::create(array('name'=>'calculation-headers','edit'=>1,'delete'=>1,'add'=>1));
            $businessUnitField=new Field(array(
                'name'=>'business_unit_id',
                'label'=>'Business unit',
                'visible'=>1,
                'type'=>'autocomplete',
                'required'=>0,
                'edit'=>1
            ));
            $calculationHeaderTable->fields()->save($businessUnitField);
            $businessUnitField->property()->save(new FieldConfig(array(
                'key'=>'resource',
                'value'=>'business_units'
            )));
            $businessUnitField->property()->save(new FieldConfig(array(
                'key'=>'field',
                'value'=>'business_unit_name'
            )));
            $calculationHeaderTable->fields()->save(new Field(array(
                'name'=>'calculation_number',
                'label'=>'Calculation number',
                'visible'=>1,
                'type'=>'number',
                'required'=>0,
                'edit'=>1
            )));
            $partnerField=new Field(array(
                'name'=>'partner_code',
                'label'=>'Partner',
                'visible'=>1,
                'type'=>'autocomplete',
                'required'=>1,
                'edit'=>1
            ));
            $calculationHeaderTable->fields()->save($partnerField);
            $partnerField->property()->save(new FieldConfig(array(
                'key'=>'resource',
                'value'=>'partners'
            )));
            $partnerField->property()->save(new FieldConfig(array(
                'key'=>'field',
                'value'=>'partner_name'
            )));
            $partnerField->property()->save(new FieldConfig(array(
                'key'=>'referencedColumn',
                'value'=>'partner_code'
            )));

            $calculationHeaderTable->fields()->save(new Field(array(
                'name'=>'calculation_date',
                'label'=>'Calculation date',
                'visible'=>1,
                'type'=>'date',
                'required'=>1,
                'edit'=>1
            )));
            $calculationHeaderTable->fields()->save(new Field(array(
                'name'=>'calculation_ddo',
                'label'=>'Calculation ddo',
                'visible'=>1,
                'type'=>'date',
                'required'=>1,
                'edit'=>1
            )));
            $calculationHeaderTable->fields()->save(new Field(array(
                'name'=>'calculation_booked',
                'label'=>'Calculation booked',
                'visible'=>1,
                'type'=>'date',
                'required'=>1,
                'edit'=>1
            )));
            $currencyFieldCH=new Field(array(
                'name'=>'currency_code',
                'label'=>'Currency',
                'visible'=>1,
                'type'=>'autocomplete',
                'required'=>1,
                'edit'=>1
            ));
            $calculationHeaderTable->fields()->save($currencyFieldCH);
            $currencyFieldCH->property()->save(new FieldConfig(array(
                'key'=>'resource',
                'value'=>'currencies'
            )));
            $currencyFieldCH->property()->save(new FieldConfig(array(
                'key'=>'field',
                'value'=>'currency_name'
            )));
            $calculationTypeField=new Field(array(
                'name'=>'calculation_type_code',
                'label'=>'Calculation type',
                'visible'=>1,
                'type'=>'autocomplete',
                'required'=>1,
                'edit'=>1
            ));
            $calculationHeaderTable->fields()->save($calculationTypeField);
            $calculationTypeField->property()->save(new FieldConfig(array(
                'key'=>'resource',
                'value'=>'calculation_types'
            )));
            $calculationTypeField->property()->save(new FieldConfig(array(
                'key'=>'field',
                'value'=>'calculation_type_code'
            )));
            $calculationTypeField->property()->save(new FieldConfig(array(
                'key'=>'referencedColumn',
                'value'=>'calculation_type_code'
            )));


            $calculationDetailsTable=FormConfig::create(array('name'=>'calculation-details','edit'=>1,'delete'=>1,'add'=>1));
            $articleField=new Field(array(
                'name'=>'article_id',
                'label'=>'Article',
                'visible'=>1,
                'type'=>'autocomplete',
                'required'=>1,
                'edit'=>1
            ));
            $calculationDetailsTable->fields()->save($articleField);
            $articleField->property()->save(new FieldConfig(array(
                'key'=>'resource',
                'value'=>'articles'
            )));
            $articleField->property()->save(new FieldConfig(array(
                'key'=>'field',
                'value'=>'article_name'
            )));
            $calculationDetailsTable->fields()->save(new Field(array(
                'name'=>'quantity',
                'label'=>'Quantity',
                'visible'=>1,
                'type'=>'number',
                'required'=>1,
                'edit'=>1
            )));
            $calculationDetailsTable->fields()->save(new Field(array(
                'name'=>'rabat',
                'label'=>'Rabat',
                'visible'=>1,
                'type'=>'number',
                'required'=>1,
                'edit'=>1
            )));
            $priceInput1Field=new Field(array(
                'name'=>'price_input1',
                'label'=>'Prc. in. no tax',
                'visible'=>1,
                'type'=>'dependency',
                'required'=>1,
                'edit'=>1
            ));
            $calculationDetailsTable->fields()->save($priceInput1Field);
            $priceInput1Field->property()->save(new FieldConfig(array(
                'key'=>'mathFunction',
                'value'=>'{"formula":"percentageBase","funcArgs":{"baseType":"number","baseField":{"formula":"rabatBase","funcArgs":{"base":"price_input2","percentage":"rabat"}},"percentage":"tariff_rate"}}'
            )));
            $priceInput1Field->property()->save(new FieldConfig(array(
                'key'=>'watches',
                'value'=>'["formData.price_input2","formData.tariffs"]'
            )));
            $priceInput2Field=new Field(array(
                'name'=>'price_input2',
                'label'=>'Prc in. tax ',
                'visible'=>1,
                'type'=>'dependency',
                'required'=>1,
                'edit'=>1
            ));
            $calculationDetailsTable->fields()->save($priceInput2Field);
            $priceInput2Field->property()->save(new FieldConfig(array(
                'key'=>'mathFunction',
                'value'=>'{"formula":"percentageAdded","funcArgs":{"baseType":"number","baseField":{"formula":"rabat","funcArgs":{"base":"price_input1","percentage":"rabat"}},"percentage":"tariff_rate"}}'
            )));
            $priceInput2Field->property()->save(new FieldConfig(array(
                'key'=>'watches',
                'value'=>'["formData.price_input1","formData.rabat"]'
            )));

            $taxInputField=new Field(array(
                'name'=>'tax_input',
                'label'=>'Tax input',
                'visible'=>1,
                'type'=>'dependency',
                'required'=>1,
                'edit'=>1
            ));
            $calculationDetailsTable->fields()->save($taxInputField);
            $taxInputField->property()->save(new FieldConfig(array(
                'key'=>'mathFunction',
                'value'=>'{"formula":"percentage","funcArgs":{"baseType":"number","base":{"formula":"rabat","funcArgs":{"base":"price_input1","percentage":"rabat"}},"percentage":"tariff_rate"}}'
            )));
            $taxInputField->property()->save(new FieldConfig(array(
                'key'=>'watches',
                'value'=>'["formData.price_input1"]'
            )));

            $calculationDetailsTable->fields()->save(new Field(array(
                'name'=>'tariff_rate_input',
                'label'=>'Tariff rate input',
                'visible'=>1,
                'type'=>'number',
                'required'=>1,
                'edit'=>1
            )));

            $marginField=new Field(array(
                'name'=>'margin',
                'label'=>'Margin',
                'visible'=>1,
                'type'=>'dependency',
                'required'=>1,
                'edit'=>1
            ));
            $calculationDetailsTable->fields()->save($marginField);
            $marginField->property()->save(new FieldConfig(array(
                'key'=>'mathFunction',
                'value'=>'{"formula":"diffFields","funcArgs":{"val1":"price_output2","val2":"price_input2"}}'
            )));
            $marginField->property()->save(new FieldConfig(array(
                'key'=>'watches',
                'value'=>'["formData.price_output2","formData.price_input2"]'
            )));
            $priceOutput1Field=new Field(array(
                'name'=>'price_output1',
                'label'=>'Prc op. no tax',
                'visible'=>1,
                'type'=>'dependency',
                'required'=>1,
                'edit'=>1
            ));
            $calculationDetailsTable->fields()->save($priceOutput1Field);
            $priceOutput1Field->property()->save(new FieldConfig(array(
                'key'=>'mathFunction',
                'value'=>'{"formula":"percentageBase","funcArgs":{"baseField":"price_output2","percentage":"tariff_rate"}}'
            )));
            $priceOutput1Field->property()->save(new FieldConfig(array(
                'key'=>'watches',
                'value'=>'["formData.price_output2","formData.tariffs"]'
            )));
            $priceOutput2Field=new Field(array(
                'name'=>'price_output2',
                'label'=>'Prc op. tax ',
                'visible'=>1,
                'type'=>'dependency',
                'required'=>1,
                'edit'=>1
            ));
            $calculationDetailsTable->fields()->save($priceOutput2Field);
            $priceOutput2Field->property()->save(new FieldConfig(array(
                'key'=>'mathFunction',
                'value'=>'{"formula":"percentageAdded","funcArgs":{"baseField":"price_output1","percentage":"tariff_rate"}}'
            )));
            $priceOutput2Field->property()->save(new FieldConfig(array(
                'key'=>'watches',
                'value'=>'["formData.price_output1"]'
            )));

            $taxOutputField=new Field(array(
                'name'=>'tax_output',
                'label'=>'Tax output',
                'visible'=>1,
                'type'=>'dependency',
                'required'=>1,
                'edit'=>1
            ));
            $calculationDetailsTable->fields()->save($taxOutputField);
            $taxOutputField->property()->save(new FieldConfig(array(
                'key'=>'mathFunction',
                'value'=>'{"formula":"percentage","funcArgs":{"base":"price_output1","percentage":"tariff_rate"}}'
            )));
            $taxOutputField->property()->save(new FieldConfig(array(
                'key'=>'watches',
                'value'=>'["formData.price_output1"]'
            )));
            $calculationDetailsTable->fields()->save(new Field(array(
                'name'=>'tariff_code',
                'label'=>'Tariff',
                'visible'=>1,
                'type'=>'number',
                'required'=>1,
                'edit'=>1
            )));
            $calculationDetailsTable->fields()->save(new Field(array(
                'name'=>'debit_credit',
                'label'=>'Debit/credit',
                'visible'=>1,
                'type'=>'number',
                'required'=>1,
                'edit'=>1
            )));
        }
    }
