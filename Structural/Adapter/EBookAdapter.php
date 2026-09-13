<?php

namespace DesignPatterns\Structural\Adapter;

/**
 * Parte 1 - Criação da Classe Adaptadora (EBookAdapter.php)
 */
class EBookAdapter implements Book
{
    /**
     * Parte 2 — Implementação do Contrato e Composição
     */
    public function __construct(private EBook $eBook)
    {
    }

    public function open(): void
    {
        $this->eBook->unlock();
    }

    public function turnPage(): void
    {
        $this->eBook->pressNext();
    }

    public function getPage(): int
    {
        $ebookPageData = $this->eBook->getPage();
        
        return $ebookPageData[0];
    }
}