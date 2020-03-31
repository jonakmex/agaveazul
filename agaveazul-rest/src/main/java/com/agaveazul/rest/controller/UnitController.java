package com.agaveazul.rest.controller;

import com.agaveazul.boundry.FindUnitsInteractor;
import com.agaveazul.boundry.port.input.FindUnitsInputPort;
import com.agaveazul.rest.model.Unit;
import org.dozer.Mapper;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.ArrayList;
import java.util.List;

@RestController
public class UnitController {
    @Autowired
    private FindUnitsInteractor findUnitsInteractor;

    @Autowired
    private Mapper mapper;

    @GetMapping(path = "units/find")
    public List<Unit> find(){
        List<Unit> units = new ArrayList<>();
        findUnitsInteractor.execute(new FindUnitsInputPort(),findUnitsOutputPort -> {
            findUnitsOutputPort.units.stream().forEach(modelUnit->{
                Unit unit = new Unit();
                mapper.map(modelUnit,unit);
                unit.setStatus("Al Corriente");
                units.add(unit);
            });
        });

        return units;
    }
}
