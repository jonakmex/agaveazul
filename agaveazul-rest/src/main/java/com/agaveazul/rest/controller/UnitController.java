package com.agaveazul.rest.controller;

import com.agaveazul.boundry.interactor.SaveUnitInteractor;
import com.agaveazul.boundry.interactor.FindUnitsInteractor;
import com.agaveazul.boundry.port.input.SaveUnitInputPort;
import com.agaveazul.boundry.port.input.FindUnitsInputPort;
import com.agaveazul.rest.exception.ExceptionFactory;
import com.agaveazul.rest.ds.Unit;
import org.dozer.Mapper;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.servlet.support.ServletUriComponentsBuilder;

import java.net.URI;
import java.util.ArrayList;
import java.util.List;

@RestController
public class UnitController {
    @Autowired
    private FindUnitsInteractor findUnitsInteractor;
    @Autowired
    private SaveUnitInteractor saveUnitInteractor;

    @Autowired
    private Mapper mapper;

    @GetMapping(path = "/units")
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

    @PostMapping(path = "/units")
    public ResponseEntity<Unit> createUnit(@RequestBody Unit unit){
        SaveUnitInputPort saveUnitInputPort = new SaveUnitInputPort();
        mapper.map(unit, saveUnitInputPort);
        saveUnitInteractor.execute(saveUnitInputPort, saveUnitOutputPort -> {
            if(!saveUnitOutputPort.success)
                throw ExceptionFactory.newResponseStatusException(HttpStatus.BAD_REQUEST,saveUnitOutputPort.messages);

            mapper.map(saveUnitOutputPort.savedUnit,unit);
        });
        URI location = ServletUriComponentsBuilder.fromCurrentRequest().path("/{id}").buildAndExpand(unit.id).toUri();
        return ResponseEntity.created(location).build();
    }

    @PutMapping(path = "/units")
    public ResponseEntity<Unit> saveUnit(@RequestBody Unit unit){
        SaveUnitInputPort saveUnitInputPort = new SaveUnitInputPort();
        mapper.map(unit, saveUnitInputPort);
        saveUnitInteractor.execute(saveUnitInputPort, saveUnitOutputPort -> {
            if(!saveUnitOutputPort.success)
                throw ExceptionFactory.newResponseStatusException(HttpStatus.BAD_REQUEST,saveUnitOutputPort.messages);

            mapper.map(saveUnitOutputPort.savedUnit,unit);
        });

        return ResponseEntity.accepted().build();
    }
}
