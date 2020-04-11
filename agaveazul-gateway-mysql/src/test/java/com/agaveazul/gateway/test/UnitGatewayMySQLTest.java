package com.agaveazul.gateway.test;

import com.agaveazul.entitiy.Unit;
import com.agaveazul.gateway.Config;
import com.agaveazul.gateway.UnitGateway;
import com.agaveazul.gateway.dto.FindUnitCriteria;
import org.junit.Test;
import org.junit.runner.RunWith;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.test.context.ContextConfiguration;
import org.springframework.test.context.junit4.SpringJUnit4ClassRunner;

import java.util.List;

import static junit.framework.TestCase.assertEquals;
@RunWith(SpringJUnit4ClassRunner.class)
@ContextConfiguration(classes = {Config.class})
public class UnitGatewayMySQLTest {

    @Autowired
    private UnitGateway unitGatewayMySQL;

    @Test
    public void gateway_not_null(){
        assertEquals(false,unitGatewayMySQL == null);
    }

    @Test
    public void query_can_connect(){
        List<Unit> units = unitGatewayMySQL.find(new FindUnitCriteria());
        assertEquals(false,units == null);
    }

    @Test
    public void query_reading_elements(){
        List<Unit> units = unitGatewayMySQL.find(new FindUnitCriteria());
        units.stream().forEach(item -> {
            System.out.println(item.getId()+"-"+item.getDescription());
        });
    }
}
