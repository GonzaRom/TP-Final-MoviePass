<?php

namespace DAO;

use Models\BillBoard as BillBoard;
use DAO\IBillBoardDAO as IBillBoardDAO;

class BillBoardDAO implements IBillBoardDAO
{
    private $billBoardArray = array();
    private $fileName;

    public function __construct()
    {
        $this->fileName = dirname(__DIR__) . "/Data/BillBoard.json";
    }

    public function add(BillBoard $newBillBoard)
    {
        $this->retriveData();
        array_push($this->billBoardArray, $newBillBoard);
        $this->saveData();
    }

    public function getAll()
    {
    }
    public function remove($id)
    {
    }
    public function get($id)
    {
        if ($id == null || empty($id)) {
            return null;
        }
        $this->retriveData();
        foreach ($this->billBoardArray as $billBoard) {
            if ($billBoard->getId() == $id) {
                return $billBoard;
            }
        }
        return null;
    }
    public function getByIdCinema($id)
    {
        if ($id == null || empty($id)) return null;

        $this->retriveData();
        foreach ($this->billBoardArray as $billBoard) {
            if ($billBoard->getIdCinema() == $id) {
                return $billBoard;
            }
        }
        return null;
    }

    private function retriveData()
    {
        $this->billBoardArray = array();
        if (file_exists($this->fileName)) {

            $jsonContent = file_get_contents($this->fileName);

            $jsonDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach ($jsonDecode as $billBoard) {
                $newBillBoard = new BillBoard();
                $newBillBoard->setId($billBoard['id']);
                $newBillBoard->setIdCinema($billBoard['idCinema']);

                array_push($this->billBoardArray, $newBillBoard);
            }
        }
    }

    private function saveData()
    {
        $jsonEncode = array();

        foreach ($this->billBoardArray as $billBoard) {
            $valuesBillBoard = array();
            $valuesBillBoard['id'] = $billBoard->getId();
            $valuesBillBoard['idCinema'] = $billBoard->getIdCinema();
            array_push($jsonEncode, $valuesBillBoard);
        }
        $jsonContent = json_encode($jsonEncode, JSON_PRETTY_PRINT);
        
        file_put_contents($this->fileName , $jsonContent);
    }
}
