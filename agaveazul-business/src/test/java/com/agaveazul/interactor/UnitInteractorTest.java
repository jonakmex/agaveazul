package com.agaveazul.interactor;

import com.agaveazul.boundry.port.callback.FindUnitsCallback;
import com.agaveazul.boundry.port.input.FindUnitsInputPort;
import com.agaveazul.boundry.port.output.FindUnitsOutputPort;
import com.agaveazul.entitiy.Unit;
import com.agaveazul.entitiy.UnitStatus;
import com.agaveazul.gateway.UnitGateway;
import com.agaveazul.gateway.dto.FindUnitCriteria;
import org.junit.Before;
import org.junit.Test;

import java.util.Arrays;

import static junit.framework.TestCase.assertEquals;
import static org.mockito.Matchers.any;
import static org.mockito.Mockito.mock;
import static org.mockito.Mockito.when;

public class UnitInteractorTest {

    private FindUnitsInteractorImpl findUnitsInteractor;

    @Before
    public void setup(){
        findUnitsInteractor = new FindUnitsInteractorImpl();
        UnitGateway unitGateway = mock(UnitGateway.class);
        Unit unit = new Unit();
        unit.setId(1L);
        unit.setDescription("Hello World");
        unit.setStatus(UnitStatus.ACTIVE);
        when(unitGateway.find(any(FindUnitCriteria.class))).thenReturn(Arrays.asList(unit));
        findUnitsInteractor.setUnitGateway(unitGateway);
    }

    @Test
    public void find_all_units(){
        findUnitsInteractor.execute(new FindUnitsInputPort(), new FindUnitsCallback() {
            @Override
            public void execute(FindUnitsOutputPort outputPort) {
                assertEquals ("Number of elements:",1,outputPort.units.size());
            }
        });

    }
}
