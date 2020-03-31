package com.agaveazul.rest.controller;

import com.agaveazul.boundry.FindUnitsInteractor;
import com.agaveazul.rest.model.Unit;
import org.dozer.Mapper;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.ArrayList;
import java.util.List;

@RestController
public class UnitController {

    private FindUnitsInteractor findUnitsInteractor;

    @Autowired
    private Mapper mapper;

    @GetMapping(path = "units/find")
    public List<Unit> find(){
        com.agaveazul.entitiy.Unit modelUnit = new com.agaveazul.entitiy.Unit();
        modelUnit.setId(1L);
        modelUnit.setDescription("Model Unit");
        Unit unit = new Unit();
        mapper.map(modelUnit,unit);
        List<Unit> units = new ArrayList<>();
        unit.setStatus("Al Corriente");
        units.add(unit);
        return units;
    }
}
