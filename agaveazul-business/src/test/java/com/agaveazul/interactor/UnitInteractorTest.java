package com.agaveazul.interactor;

import com.agaveazul.boundry.callback.FindUnitsCallback;
import com.agaveazul.boundry.port.input.FindUnitsInputPort;
import com.agaveazul.boundry.port.output.FindUnitsOutputPort;
import com.agaveazul.entitiy.Unit;
import com.agaveazul.entitiy.enums.UnitStatus;
import com.agaveazul.gateway.UnitGateway;
import com.agaveazul.gateway.dto.FindUnitCriteria;
import org.junit.Before;
import org.junit.Test;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

import static junit.framework.TestCase.assertEquals;
import static org.mockito.Matchers.any;
import static org.mockito.Mockito.mock;
import static org.mockito.Mockito.when;

public class UnitInteractorTest {

    private FindUnitsInteractorImpl findUnitsInteractor;
    private List<Unit> unitList;

    @Before
    public void setup(){
        findUnitsInteractor = new FindUnitsInteractorImpl();
        UnitGateway unitGateway = mock(UnitGateway.class);
        unitList = new ArrayList<>();
        Unit unit = new Unit();
        unit.setId(1L);
        unit.setDescription("Casa 01");
        unit.setStatus(UnitStatus.ACTIVE);
        unitList.add(unit);
        unit = new Unit();
        unit.setId(2L);
        unit.setDescription("Casa 02");
        unit.setStatus(UnitStatus.ACTIVE);
        unitList.add(unit);
        unit = new Unit();
        unit.setId(3L);
        unit.setDescription("Casa 03");
        unit.setStatus(UnitStatus.ACTIVE);
        unitList.add(unit);
        when(unitGateway.find(any(FindUnitCriteria.class))).thenReturn(unitList);
        findUnitsInteractor.setUnitGateway(unitGateway);
    }

    @Test
    public void find_all_units(){
        findUnitsInteractor.execute(new FindUnitsInputPort(), new FindUnitsCallback() {
            @Override
            public void execute(FindUnitsOutputPort outputPort) {
                assertEquals ("Number of elements:",3,outputPort.units.size());
            }
        });

    }
}
