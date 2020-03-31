package com.agaveazul.gateway;

import com.agaveazul.gateway.dto.FindUnitCriteria;
import org.junit.Before;
import org.junit.Test;

import static junit.framework.TestCase.assertEquals;

public class UnitGatewayTest {

    private UnitGateway unitGateway;

    @Before
    public void setup(){
        unitGateway = new UnitGatewayStub();
    }
    @Test
    public void basic_find_stub(){
        assertEquals ("Number of elements:",10,unitGateway.find(new FindUnitCriteria()).size());

    }
}
