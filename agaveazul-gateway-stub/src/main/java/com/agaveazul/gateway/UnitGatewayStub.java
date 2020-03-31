package com.agaveazul.gateway;

import com.agaveazul.entitiy.Unit;
import com.agaveazul.entitiy.UnitStatus;
import com.agaveazul.gateway.dto.FindUnitCriteria;

import java.util.ArrayList;
import java.util.List;

public class UnitGatewayStub implements UnitGateway {
    @Override
    public List<Unit> find(FindUnitCriteria findUnitCriteria) {
        List<Unit> units = new ArrayList<>();
        for(int i=0;i<10;i++){
            Unit unit = new Unit();
            unit.setId(new Long(i));
            unit.setDescription("Unit "+i);
            unit.setStatus(UnitStatus.ACTIVE);
            units.add(unit);
        }

        return units ;
    }
}
