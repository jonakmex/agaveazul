package com.agaveazul.gateway;

import com.agaveazul.entitiy.Unit;
import com.agaveazul.gateway.dto.FindUnitCriteria;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.jdbc.core.BeanPropertyRowMapper;
import org.springframework.jdbc.core.JdbcTemplate;
import org.springframework.jdbc.support.GeneratedKeyHolder;
import org.springframework.jdbc.support.KeyHolder;
import org.springframework.stereotype.Repository;

import java.sql.PreparedStatement;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;
import java.util.Properties;

@Repository("unitGateway")
public class UnitGatewayMySQL implements UnitGateway{
    @Autowired
    private JdbcTemplate jdbcTemplate;
    @Autowired
    private Properties sqlQueries;


    @Override
    public List<Unit> find(FindUnitCriteria criteria) {
        StringBuilder query = new StringBuilder(sqlQueries.getProperty("unit.find"));
        List<Object> parameters = new ArrayList<>();
        if(criteria.getDescription() != null) {
            query.append(sqlQueries.getProperty("units.find.description"));
            parameters.add(criteria.getDescription());
        }

        return jdbcTemplate.query(sqlQueries.getProperty("unit.find"),parameters.toArray(),new BeanPropertyRowMapper<Unit>(Unit.class));
    }

    @Override
    public Unit save(Unit newUnit) {
        Unit currentUnit = newUnit.getId() != null ? findById(newUnit.getId()) : null;
        final StringBuilder query = new StringBuilder();

        if(currentUnit != null){
            query.append(sqlQueries.getProperty("unit.update"));
            currentUnit.setDescription(newUnit.getDescription());
            jdbcTemplate.update(query.toString(),new Object[]{newUnit.getDescription(),currentUnit.getId()});
            return newUnit;
        }
        else{
            final Unit savedUnit = new Unit();
            savedUnit.setDescription(newUnit.getDescription());
            query.append(sqlQueries.getProperty("unit.insert"));
            KeyHolder keyHolder = new GeneratedKeyHolder();
            jdbcTemplate.update(cnn -> {
                PreparedStatement ps = cnn.prepareStatement(query.toString(), Statement.RETURN_GENERATED_KEYS);
                ps.setString(1,savedUnit.getDescription());
                return ps;
            },keyHolder);
            savedUnit.setId(keyHolder.getKey().longValue());
            return savedUnit;
        }
    }

    @Override
    public Unit findById(Long id) {
        return jdbcTemplate.queryForObject(sqlQueries.getProperty("unit.findById"),new Object[]{id},new BeanPropertyRowMapper<Unit>(Unit.class));
    }

    @Override
    public void delete(Long id) {
        jdbcTemplate.update(sqlQueries.getProperty("unit.delete"),new Object[]{id});
    }

}
