package com.agaveazul.entitiy;

import lombok.Data;

@Data
public class Unit {
    private Long id;
    private String description;
    private UnitStatus status;
}
