<?php

$order = new Order;

$paymentPipeline = (new Pipeline)
    ->pipe(new ApplyCoupons)
    ->pipe(new ApplyTaxes)
    ->pipe(new AddShipping)
    ->pipe(new ProcessPayment);

$orderPipeline = (new Pipeline)
    ->pipe(new CreateOrder)
    ->pipe($paymentPipeline)
    ->pipe(new SendInvoice);

$orderPipeline->process($order);