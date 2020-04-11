package com.agaveazul.gateway;

import com.agaveazul.entitiy.Unit;
import com.agaveazul.gateway.dto.FindUnitCriteria;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jdbc.core.BeanPropertyRowMapper;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.stereotype.Repository;

import java.util.List;
import java.util.Properties;

@Repository("unitGatewayMySQL")
public class UnitGatewayMySQL implements UnitGateway{
    @Autowired
    private JdbcTemplate jdbcTemplate;
    @Autowired
    private Properties sqlQueries;


    @Override
    public List<Unit> find(FindUnitCriteria criteria) {
        return jdbcTemplate.query(sqlQueries.getProperty("unit.find"),new BeanPropertyRowMapper<Unit>(Unit.class));
    }
}
